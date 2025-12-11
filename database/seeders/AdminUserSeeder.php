<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'RIZAL',
            'email' => 'admin@elgrowatch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: admin@greenwatch.id | Password: admin123');
    }
}