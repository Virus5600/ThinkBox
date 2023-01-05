@extends('template.user')

@section('title', 'Login')

@section('body')
<div class="row p-3 py-lg-5 px-lg-0">
	<div class="col col-lg-4 offset-lg-4">
		<form class="card" action="{{ route('authenticate') }}" method="POST" enctype="multipart/form-data">
			<h3 class="h3 h4-lg card-header text-center">Login</h4>

			<div class="card-body">
				{{csrf_field()}}

				<div class="form-group">
					<label class="form-label" for="email">Email/Username</label>
					<input class="form-control" type="text" name="email" value="{{old('email')}}"/>
				</div>

				<div class="form-group">
					<label class="form-label" for="password">Password</label>
					<input class="form-control" type="password" name="password"/>
				</div>

				<div class="form-check">
					<input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
					<label class="form-check-label" for="remember_me">Remember Me</label>
				</div>

				{{-- <hr class="hr-thick"> --}}

				<div class="form-group text-center">
					<button type="submit" class="btn btn-custom" data-action='submit'>Submit</button>
					{{-- <a href="{{route('register')}}" type="button" class="btn btn-secondary">Register</a> --}}
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	@if (Session::has('flash_error'))
	Swal.fire({
		title: `{{Session::get('flash_error')}}`,
		position: `top`,
		showConfirmButton: false,
		toast: true,
		timer: 10000,
		background: `#dc3545`,
		customClass: {
			title: `text-white`,
			popup: `px-3`
		},
	});
	@endif
</script>
@endsection