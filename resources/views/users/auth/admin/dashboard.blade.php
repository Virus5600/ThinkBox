@extends('template.admin')

@section('title', 'Dashboard')

@section('body')
{{-- DATABASE TOTAL SUMMATION --}}
<div class="row">
	<div class="col-12 col-md-4 col-lg my-3">
		<div class="total-block bg-primary text-white dark-shadow invisiborder rounded">
			<i class="fas fa-folder-open fa-5x"></i>
			<div class="d-flex flex-d-col flex-grow-1 text-right ml-3">
				<h6 class="my-auto">Research</h6>
				<h6 class="my-auto">9</h6>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-4 col-lg my-3">
		<div class="total-block bg-success text-white dark-shadow invisiborder rounded">
			<i class="fas fa-users fa-5x"></i>
			<div class="d-flex flex-d-col flex-grow-1 text-right ml-3">
				<h6 class="my-auto">Faculty</h6>
				<h6 class="my-auto">4</h6>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-4 col-lg my-3">
		<div class="total-block bg-warning-hover text-white dark-shadow invisiborder rounded">
			<i class="fas fa-book fa-5x"></i>
			<div class="d-flex flex-d-col flex-grow-1 text-right ml-3">
				<h6 class="my-auto">Topics</h6>
				<h6 class="my-auto">4</h6>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-4 col-lg my-3">
		<div class="total-block bg-danger text-white dark-shadow invisiborder rounded">
			<i class="fas fa-list-ul fa-5x"></i>
			<div class="d-flex flex-d-col flex-grow-1 text-right ml-3">
				<h6 class="my-auto">Course Materials</h6>
				<h6 class="my-auto">12</h6>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-4 col-lg  my-3">
		<div class="total-block bg-purple text-white dark-shadow invisiborder rounded">
			<i class="fas fa-folder-open fa-5x"></i>
			<div class="d-flex flex-d-col flex-grow-1 text-right ml-3">
				<h6 class="my-auto">Innovations</h6>
				<h6 class="my-auto">6</h6>
			</div>
		</div>
	</div>
</div>

{{-- ACTIVITY GRAPH --}}
<div class="row mt-5">
	<div class="col col-lg-8 offset-lg-2">
		<canvas id="activityGraph" class="rounded" style="border: solid 1px #707070;"></canvas>
	</div>
</div>
@endsection

@section('script')
{{-- This one will define the data set for the line graph --}}
<script type="text/javascript" src="/js/chart.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		let target = $("#activityGraph");
		let labels = [
			@for ($i = 0; $i < \Carbon\Carbon::now()->format('d'); $i++)
			@if ($i < \Carbon\Carbon::now()->format('d'))
			`{{\Carbon\Carbon::now()->format('M') . ' ' . ($i+1)}}`,
			@else
			`{{\Carbon\Carbon::now()->format('M') . ' ' . ($i+1)}}`
			@endif
			@endfor
		];
		let dataset = [{
			label: 'Reseacrch',
			data: [
				1,
				1,
				0,
				0,
				0,
				@for ($i = 4; $i < \Carbon\Carbon::now()->format('d'); $i++)
				@if ($i < \Carbon\Carbon::now()->format('d'))
					0,
				@else
					0
				@endif
				@endfor
			],
			borderColor: 'rgb(0, 123, 255)',
			tension: 0.1
		},
		{
			label: 'Topic',
			data: [
				4,
				1,
				0,
				0,
				0,
				@for ($i = 4; $i < \Carbon\Carbon::now()->format('d'); $i++)
				@if ($i < \Carbon\Carbon::now()->format('d'))
					0,
				@else
					0
				@endif
				@endfor
			],
			borderColor: 'rgb(224, 168, 0)',
			tension: 0.1
		},
		{
			label: 'Course Materials',
			data: [
				5,
				2,
				1,
				7,
				2,
				@for ($i = 4; $i < \Carbon\Carbon::now()->format('d'); $i++)
				@if ($i < \Carbon\Carbon::now()->format('d'))
					0,
				@else
					0
				@endif
				@endfor
			],
			borderColor: 'rgb(220, 53, 69)',
			tension: 0.1
		},
		{
			label: 'Innovations',
			data: [
				1,
				0,
				3,
				1,
				0,
				@for ($i = 4; $i < \Carbon\Carbon::now()->format('d'); $i++)
				@if ($i < \Carbon\Carbon::now()->format('d'))
					0,
				@else
					0
				@endif
				@endfor
			],
			borderColor: 'rgb(180, 0, 217)',
			tension: 0.1
		}];

		createLineChart(target, labels, dataset, true, "Monthly Activities", 25, 'bold');
	});
</script>
@endsection