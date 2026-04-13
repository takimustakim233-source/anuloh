<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 👑 ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // 👤 USER
        User::create([
            'name' => 'peminjam',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);
    }
}