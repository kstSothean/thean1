@extends('layouts.app')

@section('content')
<h3>Add Penalty</h3>
<form method="POST" action="{{ route('penalties.store') }}" class="mt-3">
	@csrf
	<div class="mb-3">
		<label class="form-label">Student</label>
		<select name="student_id" class="form-select" required>
			<option value="">-- Select Student --</option>
			@foreach($students as $s)
				<option value="{{ $s->id }}">{{ $s->user->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="mb-3">
		<label class="form-label">Reason</label>
		<input type="text" name="reason" class="form-control" required />
	</div>
	<div class="mb-3">
		<label class="form-label">Fine Amount</label>
		<input type="number" step="0.01" name="fine_amount" class="form-control" required />
	</div>
	<button class="btn btn-primary">Save</button>
</form>
@endsection