@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Projects</h3>
	<div class="row">
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5 class="c-grey-900 mB-20">Edit Project ({{ $project->name }})</h5>
				<form action="{{ route('admin.projects.update', $project) }}" method="POST" class="mB-20" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					@if (count($errors))
						<div class="alert alert-danger" role="alert">
							<ul class="list-unstyled">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="form-group">
						<label class="text-normal text-dark">Add More Photos</label>
						<div id="photo" class="dropzone"></div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name" class="text-normal text-dark">Project Name</label>
								<input type="text" class="form-control" name="name" value="{{ $project->name }}" required autofocus>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="thumb" class="text-normal text-dark">Project Thumbnail</label>
								<input type="file" class="form-control" name="thumb" required>
							</div>
						</div>
						<div class="col-md-4">
							<label for="tags" class="text-normal text-dark">Tags</label>
							<select name="tags[]" id="tags" class="form-control" style="width: 100%;" multiple>
								@foreach ($tags as $tag)
									@foreach ($project->tags as $ptag)
										<option value="{{ $tag->id }}" {{ ($tag->id == $ptag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
									@endforeach
								@endforeach
							</select>
						</div>
						<div class="col-md-4">
							<label for="architect" class="text-normal text-dark">Architect</label>
							<input type="text" class="form-control" name="architect" value="{{ $project->architect }}" required>
						</div>
						<div class="col-md-4">
							<label for="location" class="text-normal text-dark">Location</label>
							<input type="text" class="form-control" name="location" value="{{ $project->location }}" required>
						</div>
						<div class="col-md-4">
							<label for="name" class="text-normal text-dark">Date</label>
							<input id="project-date" type="text" class="form-control" name="date" value="{{ $project->date->format('d-m-Y') }}" required>
						</div>
					</div>
					<button class="btn btn-primary mR-20">Edit</button>
					<a href="{{ route('admin.projects.index') }}" class="btn btn-danger">Cancel</a>
				</form>
			</div>
		</div>
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				@if (count($project->photos))
					<h5 class="c-grey-900 mB-20">Project Photos (Drag and drop to sort the images)</h5>
					<ul id="sortable-project" class="list-unstyled">
						@foreach ($project->photos as $photo)
							<li class="sort-li" id="{{ $photo->id }}" style="margin-bottom: 10px;"><img src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}" alt="" style="padding: 10px; border: 1px solid #ced4da; width: auto; height: 150px; object-fit:cover;"></li>
						@endforeach
					</ul>
				@else
					<h6 class="c-grey-900 mT-10 mB-10">There are currently no photos associated with this project, upload some at the top.</h6>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@include('admin.projects.partials.upload')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
		$(function() {
			$('#sortable-project').sortable({
				stop: function() {
					$.map($(this).find('.sort-li'), function(el) {
						var itemId = el.id;
						var itemIndex = $(el).index();

						$.ajax({
							url: '{{ route('admin.projects.sort', $project) }}',
							type: 'POST',
							dataType: 'json',
							data: { itemId: itemId, itemIndex: itemIndex },
							headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content }
						});
					});
				}
			});
		});
	</script>
@endsection