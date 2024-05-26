<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'age', 'salary', 'date_of_employment', 'manager_id', 'department_id', 'is_founder'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function managedDepartment()
    {
        return $this->hasOne(Department::class, 'manager_id');
    }

    public function departmentChanges()
    {
        return $this->hasMany(DepartmentChange::class);
    }

    public function getManagers()
    {
        $managers = [];
        $currentManager = $this->manager;

        while ($currentManager) {
            $managers[] = $currentManager;
            $currentManager = $currentManager->manager;
        }

        return $managers;
    }
}
