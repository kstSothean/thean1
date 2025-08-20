@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
	<h3>Attendance</h3>
	<a href="{{ route('attendances.create') }}" class="btn btn-primary">Mark Attendance</a>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead><tr><th>Date</th><th>Student</th><th>Class</th><th>Subject</th><th>Status</th><th>Actions</th></tr></thead>
		<tbody>
		@foreach($attendances as $row)
		<tr>
			<td>{{ $row->date }}</td>
			<td>{{ $row->student->user->name ?? '' }}</td>
			<td>{{ $row->class->class_name ?? '' }}</td>
			<td>{{ $row->subject->subject_name ?? '' }}</td>
			<td><span class="badge bg-{{ $row->status === 'present' ? 'success' : ($row->status==='late'?'warning text-dark':'danger') }}">{{ ucfirst($row->status) }}</span></td>
			<td>
				<a href="{{ route('attendances.edit',$row) }}" class="btn btn-sm btn-secondary">Edit</a>
				<form action="{{ route('attendances.destroy',$row) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="mt-3">
	<a class="btn btn-outline-secondary btn-sm" href="{{ route('attendance.byClass', $classes->first()->id ?? 1) }}">Attendance by Class</a>
	<a class="btn btn-outline-secondary btn-sm" href="{{ route('attendance.report.month') }}">Monthly Report</a>
	<a class="btn btn-outline-secondary btn-sm" href="{{ route('attendance.absent') }}">Absent List</a>
</div>
@endsection