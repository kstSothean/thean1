@extends('layouts.app')

@section('content')
<div class="row g-3">
	<div class="col-md-3">
		<div class="card"><div class="card-body"><h6 class="text-muted">Students</h6><h3>{{ $stats['total_students'] ?? 0 }}</h3></div></div>
	</div>
	<div class="col-md-3">
		<div class="card"><div class="card-body"><h6 class="text-muted">Teachers</h6><h3>{{ $stats['total_teachers'] ?? 0 }}</h3></div></div>
	</div>
	<div class="col-md-3">
		<div class="card"><div class="card-body"><h6 class="text-muted">Classes</h6><h3>{{ $stats['total_classes'] ?? 0 }}</h3></div></div>
	</div>
	<div class="col-md-3">
		<div class="card"><div class="card-body"><h6 class="text-muted">Present Today</h6><h3>{{ $stats['today_present'] ?? 0 }}</h3></div></div>
	</div>
</div>
<div class="row mt-4">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Monthly Attendance</div>
			<div class="card-body">
				<canvas id="attendanceChart" height="120"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Absences Today</div>
			<div class="card-body"><h1 class="display-5">{{ $stats['today_absent'] ?? 0 }}</h1></div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('attendanceChart');
if (ctx) {
	new Chart(ctx, {
		type: 'line',
		data: { labels: [], datasets: [{ label: 'Present', data: [], borderColor: '#0d6efd' }] },
		options: { responsive: true }
	});
}
</script>
@endsection
