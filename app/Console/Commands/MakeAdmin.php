<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $username = $this->ask('username');
        $email = $this->ask('email');
        $password = $this->secret('password');
        $password_confirm = $this->secret('confirm password');

        if ($username && $email &&$password && $password == $password_confirm) {
            try {
                $user = User::create([
                    'name' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);

                $user->save();
            } catch (\Exception $e) {
                $this->error('Something went wrong!');
            }
        } else {
            $this->error('Something went wrong!');
        }
    }
}
