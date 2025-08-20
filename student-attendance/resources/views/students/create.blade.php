@extends('layouts.app')

@section('content')
<h3>Add Student</h3>
<form method="POST" action="{{ route('students.store') }}" class="mt-3">
	@csrf
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Password</label><input type="text" name="password" class="form-control" placeholder="default: password" /></div>
		<div class="col-md-6"><label class="form-label">Student Code</label><input name="student_code" class="form-control" required /></div>
		<div class="col-md-6">
			<label class="form-label">Class</label>
			<select name="class_id" class="form-select" required>
				<option value="">-- Select Class --</option>
				@foreach($classes as $c)
					<option value="{{ $c->id }}">{{ $c->class_name }} ({{ $c->grade }})</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" /></div>
		<div class="col-md-6"><label class="form-label">Address</label><input name="address" class="form-control" /></div>
		<div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" /></div>
	</div>
	<button class="btn btn-primary mt-3">Save</button>
</form>
@endsection