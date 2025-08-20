@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Students</h3>
	<a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Code</th><th>Name</th><th>Class</th><th>Phone</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($students as $s)
		<tr>
			<td>{{ $s->student_code }}</td>
			<td>{{ $s->user->name ?? '' }}</td>
			<td>{{ $s->class->class_name ?? '' }}</td>
			<td>{{ $s->phone }}</td>
			<td>
				<a href="{{ route('students.edit',$s) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('students.destroy',$s) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection