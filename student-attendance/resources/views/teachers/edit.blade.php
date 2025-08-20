@extends('layouts.app')

@section('content')
<h3>Edit Teacher</h3>
<form method="POST" action="{{ route('teachers.update',$teacher) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ $teacher->user->name }}" required /></div>
		<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $teacher->user->email }}" required /></div>
		<div class="col-md-6"><label class="form-label">Employee Code</label><input name="employee_code" class="form-control" value="{{ $teacher->employee_code }}" required /></div>
		<div class="col-md-6"><label class="form-label">Department</label><input name="department" class="form-control" value="{{ $teacher->department }}" /></div>
		<div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" value="{{ $teacher->phone }}" /></div>
	</div>
	<button class="btn btn-primary mt-3">Update</button>
</form>
@endsection