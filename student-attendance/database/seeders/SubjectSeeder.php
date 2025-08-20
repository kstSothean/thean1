<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['subject_name' => 'Mathematics', 'description' => 'Algebra, Geometry, Calculus'],
            ['subject_name' => 'Science', 'description' => 'Physics, Chemistry, Biology'],
            ['subject_name' => 'English', 'description' => 'Language and Literature'],
            ['subject_name' => 'History', 'description' => 'World and Local History'],
            ['subject_name' => 'Computer Science', 'description' => 'Programming and Algorithms'],
        ];
        foreach ($subjects as $s) {
            Subject::updateOrCreate(['subject_name' => $s['subject_name']], $s);
        }
    }
}
