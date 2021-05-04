@extends('template.user')

@section('title', 'Innovation')

@section('body')
<h2 class="h2-lg h4 mx-5 my-4"><a href="{{url()->previous()}}" class="text-dark text-decoration-none"><i class="fas fa-chevron-left fa-lg mr-3"></i>Go Back</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12">
			<h2 class="font-weight-bold text-center">{{$innovation->title}}</h2>
			<h5 class="font-weight-bold mb-2 text-center">{{$innovation->authors}} | {{$innovation->date_published->format('M d, Y')}}</h5>

			<div>{{$innovation->description}}</div>

			<br>
			<div style="height: 100vh;">
				<iframe src="/uploads/innovation/{{$innovation->posted_by}}/{{$innovation->url}}" class="w-100" style="height: 100%;" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection