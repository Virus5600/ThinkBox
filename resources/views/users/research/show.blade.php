@extends('template.user')

@section('title', 'Research')

@section('body')
<h3 class="h3-lg h4 mx-5 my-4"><a href="{{route('research')}}" class="text-dark text-decoration-none"><i class="fas fa-chevron-left mr-3"></i>Go Back</a></h3>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 col-lg-6">
			<h3 class="font-weight-bold">{{$research->title}}</h4>

			<h6 class="mb-2">{{\Carbon\Carbon::parse($research->date_published)->format("M d, Y")}}</h6>
			<h6 class="font-weight-bold mb-2">
				@for ($i = 0; $i < count($research->researchAuthors); $i++)
					@if ($i-1 == count($research->researchAuthors) || $research->authors != null)
						<a class="text-dark" href="{{route('faculty.show', [$research->researchAuthors[$i]->staff->id])}}">{{ucwords($research->researchAuthors[$i]->user->getFullName())}}</a>,
					@else
						<a class="text-dark" href="{{route('faculty.show', [$research->researchAuthors[$i]->staff->id])}}">{{ucwords($research->researchAuthors[$i]->user->getFullName())}}</a>
					@endif
				@endfor

				{{preg_replace('/,/', ', ', $research->authors)}}
			</h6>

			<br>
		</div>

		<div class="col-12 col-lg-6">
			<div class="text-right">
				<button class="btn btn-custom w-100 w-md-75 w-lg-50 text-lg-left" id="requestCopy"><i class="fas fa-copy mr-2"></i>Request a copy</button>
			</div>
			
			@if (!$research->is_file)
			<div class="text-right mt-2">
				<a class="btn btn-custom-inverted w-100 w-md-75 w-lg-50 text-lg-left" href="{{$research->url}}" target="_blank"><i class="fas fa-link mr-2"></i>Mirror 1</a>
			</div>
			@endif

			@if ($research->is_viewable)
			<br>
			{{--<div style="height: 100vh;">
				<iframe src="/uploads/research/{{$research->posted_by}}/{{$research->url}}" class="w-100" style="height: 100%;" frameborder="0"></iframe>
			</div>--}}
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			{{$research->description}}
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#requestCopy').on('click', function(e) {
			let obj = $(e.currentTarget);
			let isAuth = {{Auth::check() ? 'true' : 'false'}};
			
			@if (Auth::check())
			let email = '{{Auth::user()->email == null ? null : Auth::user()->email}}';
			@else
			let email = null;
			@endif

			if (!isAuth || email == null) {
				Swal.fire({
					title: 'Where should the author(s) reply?',
					input: 'email',
					inputLabel: 'Your email address',
					inputPlaceholder: 'Enter your email address',
					showCancelButton: true,
					allowOutsideClick: false,
					allowEscapeKey: false
				}).then((result) => {
					if (result.value) {
						Swal.fire({
							icon: 'info',
							title: 'Are you sure with this email?',
							text: 'Email: ' + result.value,
							position: 'center',
							showConfirmButton: true,
							showDenyButton: true,
							showCancelButton: true,
							confirmButtonText: "Yes",
							denyButtonText: "No",
							cancelButtonText: "Cancel",
							confirmButtonColor: "#28a745",
							denyButtonColor: "#dc3545",
							cancelButtonColor: "#444444",
							background: `#17a2b8`,
							customClass: {
								title: `text-white`,
								content: `text-white`,
								popup: `px-3`
							},
							allowOutsideClick: false,
							allowEscapeKey: false
						}).then((innerResult) => {
							if (innerResult.isConfirmed) {
								Swal.fire({
									html: `<h1 class='text-dark'><i class='fas fa-spinner fa-2x fa-spin'></i></h1>`,
									showConfirmButton: false,
									showDenyButton: false,
									showCancelButton: false,
									background: 'rgba(0, 0, 0, 0)',
									customClass: {
										title: `text-white`,
										content: `text-white`,
										popup: `px-3`
									},
									allowOutsideClick: false,
									allowEscapeKey: false
								});

								$.ajax({
									url: '{{ route("research.request_copy", [$research->id]) }}',
									type: 'POST',
									data: {
										'_token': '{{csrf_token()}}',
										'email': result.value
									},
									success: function(response) {
										Swal.fire({
											icon: 'success',
											title: response.success,
											position: 'center',
											showConfirmButton: false,
											timer: 2500,
											background: `#28a745`,
											customClass: {
												title: `text-white`,
												content: `text-white`,
												popup: `px-3`
											},
										});
									},
									error: function(response) {
										Swal.fire({
											icon: 'error',
											html: response.responseText,
											position: 'center',
											showConfirmButton: false,
											width: 'min-content',
											background: `#dc3545`,
											customClass: {
												title: `text-white`,
												content: `text-white`,
												popup: `px-3`
											},
										});
									}
								});
							}
							else if (innerResult.isDenied) {
								$("#requestCopy").trigger('click');
								return false;
							}
						});
					}
				});
			}
			else {
				Swal.fire({
					html: `<h1 class='text-dark'><i class='fas fa-spinner fa-2x fa-spin'></i></h1>`,
					showConfirmButton: false,
					showDenyButton: false,
					showCancelButton: false,
					background: 'rgba(0, 0, 0, 0)',
					customClass: {
						title: `text-white`,
						content: `text-white`,
						popup: `px-3`
					},
					allowOutsideClick: false,
					allowEscapeKey: false
				});
				
				$.ajax({
					url: '{{ route("research.request_copy", [$research->id]) }}',
					type: 'POST',
					data: {
						'_token': '{{csrf_token()}}',
						'email': email
					},
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: response.success,
							position: 'center',
							showConfirmButton: false,
							timer: 2500,
							background: `#28a745`,
							customClass: {
								title: `text-white`,
								content: `text-white`,
								popup: `px-3`
							},
						});
					},
					error: function(response) {
						Swal.fire({
							icon: 'error',
							html: response.responseText,
							position: 'center',
							showConfirmButton: false,
							width: 'min-content',
							background: `#dc3545`,
							customClass: {
								title: `text-white`,
								content: `text-white`,
								popup: `px-3`
							},
						});
					}
				});
			}
		});
	});
</script>
@endsection