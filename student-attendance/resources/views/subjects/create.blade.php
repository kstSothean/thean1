@extends('layouts.app')

@section('content')
<h3>Add Subject</h3>
<form method="POST" action="{{ route('subjects.store') }}" class="mt-3">
	@csrf
	<div class="mb-3"><label class="form-label">Subject Name</label><input name="subject_name" class="form-control" required /></div>
	<div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control"></textarea></div>
	<button class="btn btn-primary">Save</button>
</form>
@endsection