<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Position::factory(250)->create();

        Employee::factory(100)->create();
        Employee::factory(900)->create(['head_id' => 1]);
        Employee::factory(9000)->create(['head_id' => 999]);
        Employee::factory(40000)->create(['head_id' => 9999]);
    }
}
