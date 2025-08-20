@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Teachers</h3>
	<a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Code</th><th>Name</th><th>Department</th><th>Phone</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($teachers as $t)
		<tr>
			<td>{{ $t->employee_code }}</td>
			<td>{{ $t->user->name ?? '' }}</td>
			<td>{{ $t->department }}</td>
			<td>{{ $t->phone }}</td>
			<td>
				<a href="{{ route('teachers.edit',$t) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('teachers.destroy',$t) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection