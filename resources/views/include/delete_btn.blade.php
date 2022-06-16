<!-- FORM START -->
<form class="{{ $formClass }}" action="{{ $route }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}

	<input type="submit" class="{{ $class }}" data-is-container="{{ isset($isContainer) ? ($isContainer == 1 ? true : false) : false }}" data-item="{{ $item }}" value="Delete">
</form>
<!-- FORM END -->