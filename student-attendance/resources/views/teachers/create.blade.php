@extends('layouts.app')

@section('content')
<h3>Add Teacher</h3>
<form method="POST" action="{{ route('teachers.store') }}" class="mt-3">
	@csrf
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Password</label><input type="text" name="password" class="form-control" placeholder="default: password" /></div>
		<div class="col-md-6"><label class="form-label">Employee Code</label><input name="employee_code" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Department</label><input name="department" class="form-control" /></div>
		<div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" /></div>
	</div>
	<button class="btn btn-primary mt-3">Save</button>
</form>
@endsection