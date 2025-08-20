@extends('layouts.app')

@section('content')
<h3>Mark Attendance</h3>
<form method="POST" action="{{ route('attendances.store') }}" class="mt-3">
	@csrf
	<div class="row g-3">
		<div class="col-md-4">
			<label class="form-label">Class</label>
			<select name="class_id" id="class_id" class="form-select" required>
				<option value="">-- Select Class --</option>
				@foreach($classes as $c)
					<option value="{{ $c->id }}">{{ $c->class_name }} ({{ $c->grade }})</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-4">
			<label class="form-label">Subject</label>
			<select name="subject_id" class="form-select" required>
				<option value="">-- Select Subject --</option>
				@foreach($subjects as $s)
					<option value="{{ $s->id }}">{{ $s->subject_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-4">
			<label class="form-label">Date</label>
			<input type="date" name="date" value="{{ now()->toDateString() }}" class="form-control" required />
		</div>
	</div>
	<hr>
	<div id="student-list">
		<p class="text-muted">Select class to load students.</p>
	</div>
	<button class="btn btn-primary mt-3">Save Attendance</button>
</form>
<script>
const classSelect = document.getElementById('class_id');
const studentList = document.getElementById('student-list');
classSelect?.addEventListener('change', () => {
	const id = classSelect.value;
	const cls = @json($classes->map(fn($c)=>['id'=>$c->id,'students'=>$c->students->map(fn($s)=>['id'=>$s->id,'name'=>$s->user->name ?? ''])->all()])->keyBy('id'));
	studentList.innerHTML = '';
	if (!id || !cls[id]) { studentList.innerHTML = '<p class="text-muted">No students.</p>'; return; }
	const students = cls[id].students;
	let html = '<div class="table-responsive"><table class="table"><thead><tr><th>Student</th><th>Status</th></tr></thead><tbody>';
	students.forEach(s => {
		html += `<tr><td>${s.name}</td><td>
			<select name="records[${s.id}]" class="form-select form-select-sm">
				<option value="present">Present</option>
				<option value="absent">Absent</option>
				<option value="late">Late</option>
			</select>
		</td></tr>`;
	});
	html += '</tbody></table></div>';
	studentList.innerHTML = html;
});
</script>
@endsection