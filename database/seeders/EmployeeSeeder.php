<?php

namespace Database\Seeders;

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

    /**
     * Database seeder class for a single student 
     */    
        Employee::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone_no' => fake()->phoneNumber(),
            'age' => fake()->numberBetween(15, 45),
            'gender' => fake()->randomElement([
                'male',
                'female',
            ]),
        ]);
    }
}
