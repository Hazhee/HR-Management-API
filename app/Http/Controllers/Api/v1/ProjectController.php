<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return new ProjectResource($project);
    }

    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->noContent();
    }

    public function searchProjects(Request $request)
    {
        $query = Project::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->has('employee')) {
            $query->whereHas('employees', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->employee . '%');
            });
        }

        return ProjectResource::collection($query->get());
    }

    public function averageProjectDuration()
    {
        $result = DB::table('projects')
            ->join('employee_project', 'projects.id', '=', 'employee_project.project_id')
            ->join('employees', 'employee_project.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.id as department_id', 'departments.name as department_name')
            ->selectRaw('AVG(DATEDIFF(projects.end_date, projects.start_date)) as average_duration')
            ->groupBy('departments.id', 'departments.name')
            ->get();

        return response()->json($result);
    }
}
