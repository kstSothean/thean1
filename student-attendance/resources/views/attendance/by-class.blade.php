@extends('layouts.app')

@section('content')
<h3>Attendance - {{ $class->class_name }} ({{ $class->grade }})</h3>
<div class="table-responsive mt-3">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Date</th><th>Student</th><th>Subject</th><th>Status</th></tr></thead>
		<tbody>
		@foreach($records as $r)
		<tr>
			<td>{{ $r->date }}</td>
			<td>{{ $r->student->user->name ?? '' }}</td>
			<td>{{ $r->subject->subject_name ?? '' }}</td>
			<td>{{ ucfirst($r->status) }}</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection