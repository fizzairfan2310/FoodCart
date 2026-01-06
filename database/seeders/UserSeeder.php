<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@foodcart.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        // Normal User
        User::create([
            'name' => 'Test User',
            'email' => 'user@foodcart.com',
            'password' => Hash::make('123456'),
            'role' => 'user'
        ]);
    }
}