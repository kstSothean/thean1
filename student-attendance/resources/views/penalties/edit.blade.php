@extends('layouts.app')

@section('content')
<h3>Edit Penalty</h3>
<form method="POST" action="{{ route('penalties.update',$penalty) }}" class="mt-3">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label class="form-label">Student</label>
		<select name="student_id" class="form-select" required>
			@foreach($students as $s)
				<option value="{{ $s->id }}" @selected($penalty->student_id==$s->id)>{{ $s->user->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="mb-3">
		<label class="form-label">Reason</label>
		<input type="text" name="reason" class="form-control" value="{{ $penalty->reason }}" required />
	</div>
	<div class="mb-3">
		<label class="form-label">Fine Amount</label>
		<input type="number" step="0.01" name="fine_amount" class="form-control" value="{{ $penalty->fine_amount }}" required />
	</div>
	<button class="btn btn-primary">Update</button>
</form>
@endsection