<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_employees()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        Employee::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/employees');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_create_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $department = Department::factory()->create();

        $manager = Employee::factory()->create([
            'department_id' => $department->id,
        ]);
        $employeeData = [
            'full_name' => 'Hazhe Chakmaraq',
            'age' => 30,
            'salary' => 50000,
            'date_of_employment' => '2021-01-01',
            'department_id' => $department->id,
            'manager_id' => $manager->id,
            'is_founder' => false,
        ];

        $response = $this->postJson('/api/v1/employees', $employeeData);

        $response->assertStatus(201)
                 ->assertJsonPath('data.full_name', 'Hazhe Chakmaraq');
    }

    public function test_delete_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $employee = Employee::factory()->create();

        $response = $this->deleteJson("/api/v1/employees/{$employee->id}");

        $response->assertStatus(204);

    }
}
