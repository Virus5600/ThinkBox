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
	<div class="col col-lg-8 mx-auto">
		<canvas id="activityGraph" class="rounded" style="border: solid 1px #707070;"></canvas>
	</div>
</div>
<div class="row my-2">
	<div class="col col-lg-2 ml-lg-auto">
		<input type="date" class="form-control" min="{{ $min }}" max="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Carbon\Carbon::parse(Carbon\Carbon::now()->format('Y') . '-' . Carbon\Carbon::now()->format('m') . '-1')->format('Y-m-d') }}" name="from"/>
	</div>
	<div class="col col-lg-2 mr-lg-auto">
		<input type="date" class="form-control" min="{{ $min }}" max="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name="to"/>
	</div>
</div>
<div class="row my-2">
	<div class="col col-lg-4 mx-auto text-center">
		<input type="button" class="btn btn-primary mx-auto" value="View" id="redraw">
		<input type="button" class="btn btn-primary mx-auto" value="Reset" id="reset">
	</div>
</div>
@endsection

@section('script')
{{-- This one will define the data set for the line graph --}}
<script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		{{-- Function that draws the graph --}}
		var chart = null;
		const drawGraph = function(from = "{{ Carbon\Carbon::parse(Carbon\Carbon::now()->format('Y') . '-' . Carbon\Carbon::now()->format('m') . '-1')->format('Y-m-d') }}", to = "{{Carbon\Carbon::now()->format('Y-m-d')}}") {
			{{-- AJAX FOR FETCHING DATA FOR THIS RANGE --}}
			$.post('{{ route('get-activities') }}', {
				_token: '{{csrf_token()}}',
				from: from,
				to: to
			}).done((response) => {
				console.log(response);

				let setdata = [[], [], [], []];
				{{-- PROCESSING DATA --}}
				for (let k in response.research)
					setdata[0][k] = response.research[k].length;
				for (let k in response.materials)
					setdata[1][k] = response.materials[k].length;
				for (let k in response.innovations)
					setdata[2][k] = response.innovations[k].length;
				for (let k in response.dates) {
					setdata[3][k] = response.dates[k];
				}


				{{-- ASSIGNING DATA --}}
				let target = $("#activityGraph");
				let labels = setdata[3];
				let dataset = [{
					label: 'Research',
					data: setdata[0],
					borderColor: 'rgb(0, 123, 255)',
					tension: 0.1
				},
				{
					label: 'Course Materials',
					data: setdata[1],
					borderColor: 'rgb(220, 53, 69)',
					tension: 0.1
				},
				{
					label: 'Innovations',
					data: setdata[2],
					borderColor: 'rgb(180, 0, 217)',
					tension: 0.1
				}];


				if (chart != null)
					chart.destroy();

				chart = createLineChart(target, labels, dataset, true, "Activities for " + response.from + " to " + response.to, 25, 'bold');
			});
		}

		drawGraph();

		{{-- Adjusts min attribute of [name=to] field --}}
		$("[name=from]").on('change', (e) => {
			let obj = $(e.target);
			let target = $('[name=to]');

			target.attr('min', obj.val());
		});

		{{-- Redraw the graph on click --}}
		$("#redraw").on('click', (e) => {
			drawGraph(
				$("[name=from]").val(),
				$("[name=to]").val()
			)
		});

		$("#reset").on('click', () => {
			$('[name=from]').val("{{ Carbon\Carbon::parse(Carbon\Carbon::now()->format('Y') . '-' . Carbon\Carbon::now()->format('m') . '-1')->format('Y-m-d') }}");
			drawGraph()
		});
	});
</script>
@endsection