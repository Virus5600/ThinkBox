<h6 class="px-2 mt-2">Manage my Account</h6>

<hr class="hr-thick-50 my-2">

@if(\Request::is('profile/'.$id.'/edit'))
<span class="nav-link active bg-custom text-light">Edit Profile</span>
@else
<a class="nav-link custom-hover text-dark" href="{{route('profile.edit', [1])}}">Edit Profile</a>
@endif

<hr class="hr-thick-50 my-2">

<h6 class="px-2 my-2">Contents</h6>

<hr class="hr-thick-50 my-2">

@if(\Request::is('profile/materials'))
<span class="nav-link active bg-custom text-light">Course Materials</span>
@elseif (\Request::is('profile/materials/*'))
<a class="nav-link active bg-custom text-light" href="{{ route('profile.materials.index') }}">Course Materials</a>
@else
<a class="nav-link custom-hover text-dark" href="{{ route('profile.materials.index') }}">Course Materials</a>
@endif

@if(\Request::is('profile/research/list'))
<span class="nav-link active bg-custom text-light">Research</span>
@elseif(\Request::is('profile/research/list/*'))
<a class="nav-link active bg-custom text-light" href="{{ route('profile.research.index') }}">Research</a>
@else
<a class="nav-link custom-hover text-dark" href="{{ route('profile.research.index') }}">Research</a>
@endif

@if(\Request::is('profile/innovations'))
<span class="nav-link active bg-custom text-light">Innovations</span>
@elseif(\Request::is('profile/innovations/*'))
<a class="nav-link active bg-custom text-light" href="{{ route('profile.innovations.index') }}">Innovations</a>
@else
<a class="nav-link custom-hover text-dark" href="{{ route('profile.innovations.index') }}">Innovations</a>
@endif