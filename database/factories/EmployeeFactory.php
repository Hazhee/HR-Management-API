<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'age' => $this->faker->numberBetween(18, 65),
            'salary' => $this->faker->numberBetween(700, 9000),
            'date_of_employment' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'manager_id' => null,
            'department_id' => Department::factory(),
            'is_founder' => false,
        ];
    }

    public function withManager($manager)
    {
        return $this->state(function (array $attributes) use ($manager) {
            return [
                'manager_id' => $manager->id,
            ];
        });
    }

    public function founder()
    {
        return $this->state(function (array $attributes) {
            return [
                'manager_id' => null,
                'is_founder' => true,
            ];
        });
    }

    public function manager()
    {
        return $this->state(function (array $attributes) {
            return [
                'manager_id' => null,
            ];
        });
    }
}
