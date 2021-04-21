@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="{{route('admin.faculty-member.index')}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-2"></i>Manage Faculty Members</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid px-2 px-6-lg py-2">
	<div class="row">
		<div class="col-12 col-lg-3 text-center my-3">
			<img src='/images/TEMPORARY/home/{{$staff->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
		</div>

		<div class="col-12 col-lg text-center text-lg-left">
			<form class="row" action="" method="{{-- POST --}}" enctype="multipart/form-data">
				<div class="col-12 col-lg-8 my-3">
					<h2 class="font-weight-bold text-wrap">{{$staff->name}}</h2>
					<h5 class="font-weight-bold text-wrap">{{$staff->position}}</h5>
					<h5><i>{{$staff->department}}</i></h5>
					
					<br>
					
					<h1 class="font-weight-bold">Skills</h1>
					<div class="overflow-y-auto custom-scrollbar" style="max-height: 37.5vh; min-width: 100%">
						<table class="table">
							<thead>
								<tr>
									<th class="hr-thick"></th>
									<th class="hr-thick" scope="col">Name</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($skills as $s)
								<tr>
									<td>
										@php($checked = false)
										@foreach($staff->skills as $ss)
										@if ($ss->skill == $s->skill)
										<input type="checkbox" name="{{$s->skill}}" checked>
										@php($checked = true)
										@endif
										@endforeach

										@if (!$checked)
										<input type="checkbox" name="{{$s->skill}}">
										@endif
									</td>
									<td>{{$s->skill}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-12 col-lg text-center my-3">
					<button type="submit" class="btn btn-primary mx-2" data-action="update">Save Changes</button>
					<button type="button" class="btn border-primary text-primary mx-2" onclick="confirmLeave('{{ route('admin.faculty-member.index') }}')">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection