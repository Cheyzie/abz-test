<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    private string $phoneFormat = '+380 (##) ### ## ##';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'position_id' => Position::all()->random()->id,
            'hire_date' => fake()->date(),
            'phone_number' => fake()->unique()->numerify($this->phoneFormat),
            'email' => fake()->unique()->safeEmail(),
            'salary' => fake()->randomFloat(3, max: 500),
            'photo' => null,
            'head_id' => null,
            'admin_created_id' => User::all()->random()->id,
            'admin_updated_id' => User::all()->random()->id,
        ];
    }
}
