<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::factory()->count(10)->create();
        $employees = Employee::all();

        foreach ($projects as $project) {
            $project->employees()->attach(
                $employees->random(rand(1, 5))->pluck('id')->toArray()
            );
        }

    }
}
