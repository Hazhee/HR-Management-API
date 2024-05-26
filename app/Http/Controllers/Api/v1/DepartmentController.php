<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function store(Request $request)
    {
        $department = Department::create($request->all());
        return new DepartmentResource($department);
    }

    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return new DepartmentResource($department);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->noContent();
    }

    public function assignManager(Request $request, Department $department)
    {
        $employee = Employee::findOrFail($request->manager_id);
        $department->manager()->associate($employee);
        $department->save();
        return new DepartmentResource($department);
    }
}
