<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user','class'])->paginate(20);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
            'student_code' => 'required|unique:students,student_code',
            'class_id' => 'required|exists:school_classes,id',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'] ?? 'password'),
            'role' => 'student',
        ]);
        Student::create([
            'user_id' => $user->id,
            'student_code' => $data['student_code'],
            'class_id' => $data['class_id'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);
        return redirect()->route('students.index')->with('status','Student created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with(['user','class'])->findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $classes = SchoolClass::all();
        return view('students.edit', compact('student','classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$student->user_id,
            'student_code' => 'required|unique:students,student_code,'.$student->id,
            'class_id' => 'required|exists:school_classes,id',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        $student->user->update(['name'=>$data['name'],'email'=>$data['email']]);
        $student->update([
            'student_code' => $data['student_code'],
            'class_id' => $data['class_id'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);
        return redirect()->route('students.index')->with('status','Student updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $userId = $student->user_id;
        $student->delete();
        User::whereKey($userId)->delete();
        return back()->with('status','Student deleted');
    }
}
