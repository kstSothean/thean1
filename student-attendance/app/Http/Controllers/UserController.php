<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$users = User::paginate(20);
		return view('users.index', compact('users'));
	}

	public function edit(string $id)
	{
		$user = User::findOrFail($id);
		return view('users.edit', compact('user'));
	}

	public function update(Request $request, string $id)
	{
		$user = User::findOrFail($id);
		$data = $request->validate([
			'role' => 'required|in:admin,teacher,student',
		]);
		$user->update($data);
		return redirect()->route('users.index')->with('status','Role updated');
	}

	public function destroy(string $id)
	{
		User::whereKey($id)->delete();
		return back()->with('status','User deleted');
	}
}
