<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\DepartmentChange;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    public function store(EmployeeRequest $request)
    {
        if ($request->input('is_founder')) {
            if (Employee::whereNull('manager_id')->exists()) {
                throw ValidationException::withMessages([
                    'is_founder' => 'There can only be one founder in the company.'
                ]);
            }
            $request->merge(['manager_id' => null]);
        } else {
            if (!$request->input('manager_id')) {
                throw ValidationException::withMessages([
                    'manager_id' => 'Each employee must have a manager.'
                ]);
            }
        }
        $employee = Employee::create($request->validated());
        return new EmployeeResource($employee);
        
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return new EmployeeResource($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->noContent();
    }

    public function getManagers(Employee $employee)
    {
        $managers = $employee->getManagers();
        return response()->json(['data' => EmployeeResource::collection($managers)]);
    }

    public function averageSalaryByAgeGroup()
    {
        $result = Employee::selectRaw('FLOOR(age/10)*10 as age_group, AVG(salary) as average_salary')
            ->groupBy('age_group')
            ->orderBy('age_group')
            ->get();
        return response()->json($result);
    }

    public function topCompletedProjects($departmentId)
    {
        $employees = Employee::where('department_id', $departmentId)
            ->whereHas('projects', function ($query) {
                $query->where('status', 'completed');
            })
            ->withCount(['projects' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->orderBy('projects_count', 'desc')
            ->take(10)
            ->get();
        return EmployeeResource::collection($employees);
    }

    public function changeDepartment(Request $request, Employee $employee)
    {
        $request->validate([
            'new_department_id' => 'required|exists:departments,id',
        ]);

        $newDepartmentId = $request->input('new_department_id');

        if ($employee->department_id !== $newDepartmentId) {
            DepartmentChange::create([
                'employee_id' => $employee->id,
                'old_department_id' => $employee->department_id,
                'new_department_id' => $newDepartmentId,
                'change_date' => Carbon::now(),
            ]);

            $employee->update(['department_id' => $newDepartmentId]);
        }

        return response()->json(['message' => 'Department changed successfully']);
    }

    public function neverChangedDepartment()
    {
        $employees = Employee::whereDoesntHave('departmentChanges')->get();
        return EmployeeResource::collection($employees);
    }
}
