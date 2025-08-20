<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penalty;
use App\Models\Student;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::inRandomOrder()->take(5)->get();
        foreach ($students as $index => $student) {
            Penalty::updateOrCreate([
                'student_id' => $student->id,
                'reason' => 'Late attendance',
            ], [
                'fine_amount' => rand(5, 20),
            ]);
        }
    }
}
