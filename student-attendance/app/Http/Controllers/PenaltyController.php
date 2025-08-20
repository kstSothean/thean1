<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penalty;
use App\Models\Student;

class PenaltyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penalties = Penalty::with('student.user')->latest('created_at')->paginate(20);
        return view('penalties.index', compact('penalties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('user')->get();
        return view('penalties.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'reason' => 'required|string',
            'fine_amount' => 'required|numeric|min:0',
        ]);
        Penalty::create($data);
        return redirect()->route('penalties.index')->with('status','Penalty added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penalty = Penalty::findOrFail($id);
        $students = Student::with('user')->get();
        return view('penalties.edit', compact('penalty','students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penalty = Penalty::findOrFail($id);
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'reason' => 'required|string',
            'fine_amount' => 'required|numeric|min:0',
        ]);
        $penalty->update($data);
        return redirect()->route('penalties.index')->with('status','Penalty updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Penalty::whereKey($id)->delete();
        return back()->with('status','Penalty deleted');
    }
}
