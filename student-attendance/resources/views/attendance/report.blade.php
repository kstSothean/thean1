@extends('layouts.app')

@section('content')
<h3>Monthly Attendance Report</h3>
<form method="GET" class="row g-3 mb-3">
	<div class="col-auto">
		<input type="month" name="month" value="{{ $month }}" class="form-control" />
	</div>
	<div class="col-auto">
		<button class="btn btn-secondary">Filter</button>
	</div>
</form>
<div class="row g-3">
	@foreach(['present'=>'success','absent'=>'danger','late'=>'warning'] as $key => $color)
	<div class="col-md-4">
		<div class="card border-{{ $color }}">
			<div class="card-body">
				<h5 class="card-title text-capitalize">{{ $key }}</h5>
				<p class="display-6">{{ $summary[$key] ?? 0 }}</p>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection