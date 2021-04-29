@extends('template.user')

@section('title', 'Login')

@section('body')
<div class="row p-3 py-lg-5 px-lg-0">
	<div class="col col-lg-4 offset-lg-4">
		<form class="card" action="" method="{{-- POST --}}" enctype="multipart/form-data">
			<h3 class="h3 h4-lg card-header text-center">Login</h4>

			<div class="card-body">
				{{csrf_field()}}

				<div class="form-group">
					<label class="form-label" for="email">Email</label>
					<input class="form-control" type="email" name="email" value="{{old('email')}}"/>
				</div>

				<div class="form-group">
					<label class="form-label" for="password">Password</label>
					<input class="form-control" type="password" name="password" value="{{old('password')}}"/>
				</div>

				<hr class="hr-thick">

				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary" data-action='submit'>Submit</button>
					{{-- <a href="{{route('register')}}" type="button" class="btn btn-secondary">Register</a> --}}
				</div>
			</div>
		</form>
	</div>
</div>
@endsection