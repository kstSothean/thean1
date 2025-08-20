@extends('layouts.app')

@section('content')
<h3>Users</h3>
<div class="table-responsive mt-3">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($users as $u)
		<tr>
			<td>{{ $u->name }}</td>
			<td>{{ $u->email }}</td>
			<td><span class="badge text-bg-secondary">{{ $u->role ?? 'student' }}</span></td>
			<td>
				<a href="{{ route('users.edit',$u) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('users.destroy',$u) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection