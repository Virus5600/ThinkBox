<form class="w-100" action="{{$route}}" method="GET" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" name="routeName" value="{{$target_route}}">
	{!! $param !!}
	<h2 class="text-center w-100"><button type="submit" class='btn btn-link m-0 p-0' style="font-size: inherit; font-weight: inherit; line-height: inherit; margin: inherit!important;">Login</button> to access this section.</h2>
	<script id="remove">$("#matContainer").addClass("bg-custom-light"); $("#remove").remove();</script>
</form>