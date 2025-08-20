@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Classes</h3>
	<a href="{{ route('classes.create') }}" class="btn btn-primary">Add Class</a>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered ">
		<thead><tr><th>Name</th><th>Grade</th><th>Teacher</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($classes as $c)
		<tr>
			<td>{{ $c->class_name }}</td>
			<td>{{ $c->grade }}</td>
			<td>{{ $c->teacher->user->name ?? '-' }}</td>
			<td>
				<a href="{{ route('classes.edit',$c) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('classes.destroy',$c) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection