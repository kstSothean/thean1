@extends('layouts.app')

@section('content')
<h3>Edit Class</h3>
<form method="POST" action="{{ route('classes.update',$class) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="row g-3">
		<div class="col-md-6"><label class="form-label">Class Name</label><input name="class_name" class="form-control" value="{{ $class->class_name }}" required /></div>
		<div class="col-md-6"><label class="form-label">Grade</label><input name="grade" class="form-control" value="{{ $class->grade }}" required /></div>
		<div class="col-md-6">
			<label class="form-label">Class Teacher</label>
			<select name="teacher_id" class="form-select">
				<option value="">-- None --</option>
				@foreach($teachers as $t)
					<option value="{{ $t->id }}" @selected($class->teacher_id==$t->id)>{{ $t->user->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<button class="btn btn-primary mt-3">Update</button>
</form>
@endsection