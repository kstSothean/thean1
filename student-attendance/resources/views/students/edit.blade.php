@extends('layouts.app')

@section('content')
<h3>Edit Student</h3>
<form method="POST" action="{{ route('students.update',$student) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ $student->user->name }}" required /></div>
		<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $student->user->email }}" required /></div>
		<div class="col-md-6"><label class="form-label">Student Code</label><input name="student_code" class="form-control" value="{{ $student->student_code }}" required /></div>
		<div class="col-md-6">
			<label class="form-label">Class</label>
			<select name="class_id" class="form-select" required>
				@foreach($classes as $c)
					<option value="{{ $c->id }}" @selected($student->class_id==$c->id)>{{ $c->class_name }} ({{ $c->grade }})</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}" /></div>
		<div class="col-md-6"><label class="form-label">Address</label><input name="address" class="form-control" value="{{ $student->address }}" /></div>
		<div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" value="{{ $student->phone }}" /></div>
	</div>
	<button class="btn btn-primary mt-3">Update</button>
</form>
@endsection