@extends('template.user')

@section('title', 'Announcements')

@section('body')
<h2 class="mx-5 my-4"><a href="{{route('announcements.index')}}" class="text-dark text-decoration-none"><i class="fas fa-chevron-left fa-lg mr-3"></i>Announcements</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<h2 class="font-weight-bold mb-2"><a href="https://www.national-u.edu.ph/payment-options/" class="text-dark text-decoration-none">Payment Options</a></h2>

	<div class="text-center my-4">
		<img src="/images/TEMPORARY/home/announcement{{$id}}.jpg" class="img-fluid"/>
	</div>

	<pre class="custom-font h5 font-weight-normal">
		Good news, Nationalians!
		Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.
		You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.
	</pre>
</div>
@endsection