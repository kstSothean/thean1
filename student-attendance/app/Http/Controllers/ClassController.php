<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Teacher;

class ClassController extends Controller
{
	public function index()
	{
		$classes = SchoolClass::with('teacher.user')->paginate(20);
		return view('classes.index', compact('classes'));
	}

	public function create()
	{
		$teachers = Teacher::with('user')->get();
		return view('classes.create', compact('teachers'));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'class_name' => 'required|string',
			'grade' => 'required|string',
			'teacher_id' => 'nullable|exists:teachers,id',
		]);
		SchoolClass::create($data);
		return redirect()->route('classes.index')->with('status','Class created');
	}

	public function show(string $id)
	{
		$class = SchoolClass::with(['teacher.user','students.user'])->findOrFail($id);
		return view('classes.show', compact('class'));
	}

	public function edit(string $id)
	{
		$class = SchoolClass::findOrFail($id);
		$teachers = Teacher::with('user')->get();
		return view('classes.edit', compact('class','teachers'));
	}

	public function update(Request $request, string $id)
	{
		$class = SchoolClass::findOrFail($id);
		$data = $request->validate([
			'class_name' => 'required|string',
			'grade' => 'required|string',
			'teacher_id' => 'nullable|exists:teachers,id',
		]);
		$class->update($data);
		return redirect()->route('classes.index')->with('status','Class updated');
	}

	public function destroy(string $id)
	{
		SchoolClass::whereKey($id)->delete();
		return back()->with('status','Class deleted');
	}
}
