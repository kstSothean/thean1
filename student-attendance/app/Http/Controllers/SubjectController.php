<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
	public function index()
	{
		$subjects = Subject::paginate(20);
		return view('subjects.index', compact('subjects'));
	}

	public function create()
	{
		return view('subjects.create');
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'subject_name' => 'required|string|unique:subjects,subject_name',
			'description' => 'nullable|string',
		]);
		Subject::create($data);
		return redirect()->route('subjects.index')->with('status','Subject created');
	}

	public function show(string $id)
	{
		$subject = Subject::findOrFail($id);
		return view('subjects.show', compact('subject'));
	}

	public function edit(string $id)
	{
		$subject = Subject::findOrFail($id);
		return view('subjects.edit', compact('subject'));
	}

	public function update(Request $request, string $id)
	{
		$subject = Subject::findOrFail($id);
		$data = $request->validate([
			'subject_name' => 'required|string|unique:subjects,subject_name,'.$subject->id,
			'description' => 'nullable|string',
		]);
		$subject->update($data);
		return redirect()->route('subjects.index')->with('status','Subject updated');
	}

	public function destroy(string $id)
	{
		Subject::whereKey($id)->delete();
		return back()->with('status','Subject deleted');
	}
}
