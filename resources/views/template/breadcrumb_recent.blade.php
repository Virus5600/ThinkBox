<p class="text-center text-lg-left mx-0 mx-lg-5 my-4">
	@php ($link = "")
	@for($i = count(Request::segments())-1; $i <= count(Request::segments()); $i++)
		@if ($i < count(Request::segments()) && $i > 0)
			@php ($link .= "/" . Request::segment($i))
			<a href="{{$link}}">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a> >
		@else
			{{ucwords(str_replace('-',' ',Request::segment($i)))}}
		@endif
	@endfor
</p>