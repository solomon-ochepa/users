<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "$1Password;";
        $users = [
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'phone' => '+2340000000000',
                'email' => 'admin@example.test',
                'password' => $password,
            ],
            [
                'username' => 'demo',
                'first_name' => 'Demo',
                'last_name' => 'User',
                'phone' => '+2340000000001',
                'email' => 'demo@example.test',
                'password' => $password,
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(Arr::only($user, ['username', 'phone', 'email']), $user);
        }
    }
}
