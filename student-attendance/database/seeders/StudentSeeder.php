<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = SchoolClass::pluck('id')->all();
        if (empty($classes)) {
            return;
        }
        for ($i = 1; $i <= 10; $i++) {
            $user = User::updateOrCreate([
                'email' => "student{$i}@school.test",
            ], [
                'name' => "Student {$i}",
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            Student::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'student_code' => sprintf('S%04d', $i),
                'class_id' => $classes[array_rand($classes)],
                'date_of_birth' => now()->subYears(rand(15, 18))->subDays(rand(0, 365))->toDateString(),
                'address' => '123 Main St',
                'phone' => '080000000' . $i,
            ]);
        }
    }
}
