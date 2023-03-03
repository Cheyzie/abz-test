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

    public function head_level(?int $id): int {
        $level = 0;
        $user_id = User::where('id', $id)->first()?->head_id;
        while ($user_id) {
            $level++;
            $user_id = User::where('id', $user_id)->first()?->head_id;
        }
        return $level;
    }

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
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'salary' => fake()->randomFloat(2, max: 500000),
            'photo' => fake()->imageUrl(300, 300, 'human'),
            'head_id' => null,
            'admin_created_id' => User::all()->random()->id,
            'admin_updated_id' => User::all()->random()->id,
        ];
    }
}
