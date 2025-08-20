<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Teacher;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['class_name' => 'Class A', 'grade' => 'Grade 10'],
            ['class_name' => 'Class B', 'grade' => 'Grade 11'],
            ['class_name' => 'Class C', 'grade' => 'Grade 12'],
        ];
        $teachers = Teacher::get();
        foreach ($classes as $index => $data) {
            $teacherId = $teachers[$index % max(1, $teachers->count())]->id ?? null;
            SchoolClass::updateOrCreate([
                'class_name' => $data['class_name'],
            ], [
                'grade' => $data['grade'],
                'teacher_id' => $teacherId,
            ]);
        }
    }
}
