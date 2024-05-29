<?php

namespace Database\Factories;

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
            // 'name' => $this->faker->name(),
            // 'birth_date' => $this->faker->date(),
            // 'gender' => $this->faker->randomElement,
            // 'religion' => $this->faker->word(),
            // 'phone_number' => $this->faker->phoneNumber(),
            // 'last_education' => $this->faker->word(),
            // 'address' => $this->faker->address(),
            // 'hire_date_start' => $this->faker->date(),
            // 'hire_date_end' => $this->faker->date(),
            // 'position' => $this->faker->word(),
            // 'employee_type' => $this->faker->randomElement,
            // 'bpjs' => $this->faker->randomElement,
        ];
    }
}
