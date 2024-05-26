<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentChange extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'old_department_id', 'new_department_id', 'change_date'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function oldDepartment()
    {
        return $this->belongsTo(Department::class, 'old_department_id');
    }

    public function newDepartment()
    {
        return $this->belongsTo(Department::class, 'new_department_id');
    }
}
