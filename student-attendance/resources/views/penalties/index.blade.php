@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Penalties</h3>
	<a href="{{ route('penalties.create') }}" class="btn btn-primary">Add Penalty</a>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead><tr><th>Student</th><th>Reason</th><th>Fine</th><th>Date</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($penalties as $p)
		<tr>
			<td>{{ $p->student->user->name ?? '' }}</td>
			<td>{{ $p->reason }}</td>
			<td>${{ number_format($p->fine_amount, 2) }}</td>
			<td>{{ optional($p->created_at)->format('Y-m-d') }}</td>
			<td>
				<a class="btn btn-sm btn-secondary" href="{{ route('penalties.edit',$p) }}">Edit</a>
				<form action="{{ route('penalties.destroy',$p) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection