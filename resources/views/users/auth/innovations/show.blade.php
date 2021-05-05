@extends('template.user')

@section('title', 'Innovation')

@section('css')
<style type="text/css">
	@media (min-width: 992px) {
		.request-btn {
			position: absolute;
			right: 0;
		}
	}
</style>
@endsection

@section('body')
<h3 class="h3-lg h4 mx-5 my-4"><a href="{{url()->previous()}}" class="text-dark text-decoration-none"><i class="fas fa-chevron-left mr-3"></i>Go Back</a></h3>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12">
			@if ($innovation->is_downloadable)
			<div class="request-btn text-center">
				<button class="btn btn-success">Request a copy</button>
			</div>
			@endif
			<h2 class="font-weight-bold text-center">{{$innovation->title}}</h2>
			<h5 class="font-weight-bold mb-2 text-center">{{$innovation->authors}} | {{$innovation->date_published->format('M d, Y')}}</h5>

			<div>{{$innovation->description}}</div>

			@if ($innovation->is_downloadable)
			<br>
			<div style="height: 100vh;">
				<iframe src="/uploads/innovation/{{$innovation->posted_by}}/{{$innovation->url}}" class="w-100" style="height: 100%;" frameborder="0"></iframe>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection