<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$stats = [
			'total_students' => Student::count(),
			'total_teachers' => Teacher::count(),
			'total_classes' => SchoolClass::count(),
			'today_present' => Attendance::where('date', today()->toDateString())->where('status', 'present')->count(),
			'today_absent' => Attendance::where('date', today()->toDateString())->where('status', 'absent')->count(),
		];

		return view('dashboard', compact('stats'));
	}
}
