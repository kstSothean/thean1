@extends('layouts.app')

@section('content')
<h3>Edit Subject</h3>
<form method="POST" action="{{ route('subjects.update',$subject) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="mb-3"><label class="form-label">Subject Name</label><input name="subject_name" class="form-control" value="{{ $subject->subject_name }}" required /></div>
	<div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control">{{ $subject->description }}</textarea></div>
	<button class="btn btn-primary">Update</button>
</form>
@endsection