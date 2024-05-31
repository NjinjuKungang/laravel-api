<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the student model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone_no' => fake()->phoneNumber(),
            'age' => fake()->numberBetween(15, 45),
            'gender' => fake()->randomElement([
                'male',
                'female',
            ]),


        ];
    } 
}
