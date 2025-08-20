@extends('layouts.app')

@section('content')
<h3>Add Class</h3>
<form method="POST" action="{{ route('classes.store') }}" class="mt-3">
	@csrf
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Class Name</label><input name="class_name" class="form-control" required /></div>
		<div class="col-md-6"><label class="form-label">Grade</label><input name="grade" class="form-control" required /></div>
		<div class="col-md-6">
			<label class="form-label">Class Teacher</label>
			<select name="teacher_id" class="form-select">
				<option value="">-- None --</option>
				@foreach($teachers as $t)
					<option value="{{ $t->id }}">{{ $t->user->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<button class="btn btn-primary mt-3">Save</button>
</form>
@endsection