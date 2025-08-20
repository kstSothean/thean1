<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Mathematics', 'Science', 'English'];
        for ($i = 1; $i <= 3; $i++) {
            $user = User::where('email', "teacher{$i}@school.test")->first();
            if (!$user) {
                continue;
            }
            Teacher::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'employee_code' => sprintf('T%04d', $i),
                'department' => $departments[$i - 1],
                'phone' => '090000000' . $i,
            ]);
        }
    }
}
