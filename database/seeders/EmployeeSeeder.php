<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->founder()->create();

        Department::all()->each(function ($department) {
            // Create the manager for the department
            $manager = Employee::factory()->manager()->create([
                'department_id' => $department->id,
            ]);

            // Update the department to set its manager
            $department->update(['manager_id' => $manager->id]);

            // Create additional employees for the department and assign them to the manager
            Employee::factory()->count(10)->create()->each(function ($employee) use ($department, $manager) {
                $employee->update([
                    'department_id' => $department->id,
                    'manager_id' => $manager->id,
                ]);
            });
        });
    }
}
