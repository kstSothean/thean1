<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Subject;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::with('students')->get();
        $subjects = Subject::all();
        $attendances = Attendance::latest()->limit(50)->with(['student.user','class','subject'])->get();
        return view('attendance.index', compact('classes','subjects','attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::with('students')->get();
        $subjects = Subject::all();
        return view('attendance.create', compact('classes','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'records' => 'required|array',
        ]);

        foreach ($data['records'] as $studentId => $status) {
            Attendance::updateOrCreate([
                'student_id' => $studentId,
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id'],
                'date' => $data['date'],
            ], [
                'status' => $status,
            ]);
        }

        return redirect()->route('attendances.index')->with('status', 'Attendance saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with(['student.user','class','subject'])->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        return view('attendance.edit', compact('attendance','classes','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $data = $request->validate([
            'status' => 'required|in:present,absent,late',
            'remark' => 'nullable|string',
        ]);
        $attendance->update($data);
        return redirect()->route('attendances.index')->with('status','Attendance updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Attendance::whereKey($id)->delete();
        return back()->with('status','Attendance deleted');
    }

    public function byClass(SchoolClass $class)
    {
        $records = Attendance::where('class_id', $class->id)->with(['student.user','subject'])->orderByDesc('date')->paginate(30);
        return view('attendance.by-class', compact('class','records'));
    }

    public function reportByMonth(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $start = \Illuminate\Support\Carbon::parse($month.'-01')->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $summary = Attendance::selectRaw('status, count(*) as total')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->groupBy('status')
            ->pluck('total','status');
        return view('attendance.report', compact('month','summary'));
    }

    public function absentList()
    {
        $today = today()->toDateString();
        $records = Attendance::where('date', $today)->where('status','absent')->with('student.user','class','subject')->get();
        return view('attendance.absent', compact('records','today'));
    }
}
