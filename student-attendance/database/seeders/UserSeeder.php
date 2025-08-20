<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate([
            'email' => 'admin@school.test',
        ], [
            'name' => 'System Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3 Teachers placeholder user accounts
        for ($i = 1; $i <= 3; $i++) {
            User::updateOrCreate([
                'email' => "teacher{$i}@school.test",
            ], [
                'name' => "Teacher {$i}",
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]);
        }
    }
}
