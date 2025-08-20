@extends('layouts.app')

@section('content')
<h3>Absent Students - {{ $today }}</h3>
<div class="table-responsive mt-3">
	<table class="table table-striped table-bordered">
		<thead><tr><th>Student</th><th>Class</th><th>Subject</th></tr></thead>
		<tbody>
		@forelse($records as $r)
		<tr>
			<td>{{ $r->student->user->name ?? '' }}</td>
			<td>{{ $r->class->class_name ?? '' }}</td>
			<td>{{ $r->subject->subject_name ?? '' }}</td>
		</tr>
		@empty
		<tr><td colspan="3" class="text-center text-muted">No absences today</td></tr>
		@endforelse
		</tbody>
	</table>
</div>
@endsection