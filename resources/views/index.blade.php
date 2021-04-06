@extends('template.user')

@section('title', 'Home')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 100vh!important; background: #fff url('/images/UI/banners/index.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop">
		<div class="col-6 ml-5" style="position: relative; top: 50%;">
			<h1 class="text-light">
				Countless number of IDEAS<br>
				that is INNOVATIVE, in a form of file
			</h1>

			<hr class="hr-thick" style="border-color: white;" />
		</div>
	</div>
</div>

<div class="container-fluid my-5">
	{{-- MAX: 3 ANNOUNCEMENTS --}}
	<div class="card-deck px-7">
		<div class="card shadow">
			<div class="card-body">
				<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement1.jpg') no-repeat center"></div>
				<h5 class="card-title">Payment Options</h5>
				<p class="card-text text-truncate">
					Good news, Nationalians!<br>
					Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.<br>
					You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.<br>
				</p>
			</div>
		</div>

		<div class="card shadow">
			<div class="card-body">
				<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement1.jpg') no-repeat center"></div>
				<h5 class="card-title">Payment Options</h5>
				<p class="card-text text-truncate">
					Good news, Nationalians!<br>
					Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.<br>
					You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.<br>
				</p>
			</div>
		</div>

		<div class="card shadow">
			<div class="card-body">
				<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/announcement1.jpg') no-repeat center"></div>
				<h5 class="card-title">Payment Options</h5>
				<p class="card-text text-truncate">
					Good news, Nationalians!<br>
					Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.<br>
					You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.<br>
				</p>
			</div>
		</div>
	</div>
</div>
@endsection