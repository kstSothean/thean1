<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(20);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
            'employee_code' => 'required|unique:teachers,employee_code',
            'department' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'] ?? 'password'),
            'role' => 'teacher',
        ]);
        Teacher::create([
            'user_id' => $user->id,
            'employee_code' => $data['employee_code'],
            'department' => $data['department'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);
        return redirect()->route('teachers.index')->with('status','Teacher created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$teacher->user_id,
            'employee_code' => 'required|unique:teachers,employee_code,'.$teacher->id,
            'department' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        $teacher->user->update(['name'=>$data['name'],'email'=>$data['email']]);
        $teacher->update([
            'employee_code' => $data['employee_code'],
            'department' => $data['department'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);
        return redirect()->route('teachers.index')->with('status','Teacher updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $userId = $teacher->user_id;
        $teacher->delete();
        User::whereKey($userId)->delete();
        return back()->with('status','Teacher deleted');
    }
}
