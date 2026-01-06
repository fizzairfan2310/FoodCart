<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // ⬅️ Yeh add karo

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User (hashed password)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@foodcart.com',
            'password' => Hash::make('admin123'),  // ⬅️ Hash laga diya
            'role' => 'admin'
        ]);

        // Create Sample Regular User (hashed password)
        User::create([
            'name' => 'John Doe',
            'email' => 'user@foodcart.com',
            'password' => Hash::make('user123'),  // ⬅️ Hash laga diya
            'role' => 'user'
        ]);

        echo "✅ Admin created: admin@foodcart.com / admin123\n";
        echo "✅ User created: user@foodcart.com / user123\n";
    }
}