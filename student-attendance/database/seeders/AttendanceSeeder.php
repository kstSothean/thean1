<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Support\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::all();
        $classes = SchoolClass::all();
        if ($students->isEmpty() || $subjects->isEmpty() || $classes->isEmpty()) {
            return;
        }

        $start = now()->startOfMonth();
        $end = now()->endOfMonth();
        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                    if ($date->isWeekend()) continue;
                    Attendance::updateOrCreate([
                        'student_id' => $student->id,
                        'class_id' => $student->class_id,
                        'subject_id' => $subject->id,
                        'date' => $date->toDateString(),
                    ], [
                        'status' => collect(['present', 'absent', 'late'])->random(),
                        'remark' => null,
                    ]);
                }
            }
        }
    }
}
