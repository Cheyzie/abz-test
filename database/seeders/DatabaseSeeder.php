<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use App\Services\PhotoService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $photo = file_get_contents('https://dummyimage.com/300x300/000/fff.png&text=Seeded');

        $photoName = 'public/photos/seeded.png';

        Storage::disk('local')->put($photoName, $photo);

        User::factory(10)->create();

        Position::factory(250)->create();

        for ($i = 0; $i < 200; $i++) {
            Employee::factory(250)->create([
                'photo' => random_int(0,1) ? $photoName : null,
            ]);
        }
    }
}
