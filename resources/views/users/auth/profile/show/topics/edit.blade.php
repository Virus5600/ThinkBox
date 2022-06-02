@extends('template.user')

@section('title', 'My Profile')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.topics.index') }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>{{$selected_topic->topic_name}}</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{route('profile.topics.update', [$selected_topic->id])}}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}

				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="topic_name" class="form-label font-weight-bold important">Topic Name</label>
							<input type="text" name="topic_name" id="topic_name" class="form-control" value="{{$selected_topic->topic_name}}"/>
							<p><span class="font-weight-bold">NOTE:</span> Editing the name will <span class="font-weight-bold">move</span> all the materials under this topic to the given topic.</p>
							<span style="color: #FC1838">{!!$errors->first('topic_name')!!}</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 text-center text-lg-left">
						<button type="button" class="btn btn-custom" data-click-target="#submitBtn" data-action="confirm" data-title="Move contents to selected topic?" data-message="Are you sure you want to move all the contents of this topic to a new one?" data-mimic="update">Submit</button>
						<button type="submit" class="btn btn-custom hidden" data-action="update" id="submitBtn">Submit</button>
						<a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.topics.index') }}')" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		// AUTOCOMPLETE
		let availableTags = [
			@foreach ($topics as $t)
			'{{$t->topic_name}}',
			@endforeach
		];

		$('#topic_name').autocomplete({
			source: availableTags,
			delay: 0
		});
	});
</script>
@endsection