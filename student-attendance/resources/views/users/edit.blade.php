@extends('layouts.app')

@section('content')
<h3>Edit User Role</h3>
<form method="POST" action="{{ route('users.update',$user) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input type="text" class="form-control" value="{{ $user->name }}" disabled />
	</div>
	<div class="mb-3">
		<label class="form-label">Email</label>
		<input type="email" class="form-control" value="{{ $user->email }}" disabled />
	</div>
	<div class="mb-3">
		<label class="form-label">Role</label>
		<select name="role" class="form-select" required>
			@foreach(['admin','teacher','student'] as $r)
				<option value="{{ $r }}" @selected($user->role===$r)>{{ ucfirst($r) }}</option>
			@endforeach
		</select>
	</div>
	<button class="btn btn-primary">Update</button>
</form>
@endsection