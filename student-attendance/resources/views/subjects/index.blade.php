@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Subjects</h3>
	<a href="{{ route('subjects.create') }}" class="btn btn-primary">Add Subject</a>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Name</th><th>Description</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($subjects as $s)
		<tr>
			<td>{{ $s->subject_name }}</td>
			<td>{{ $s->description }}</td>
			<td>
				<a href="{{ route('subjects.edit',$s) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('subjects.destroy',$s) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection