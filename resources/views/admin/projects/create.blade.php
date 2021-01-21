@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Projects</h3>
	<div class="row">
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5 class="c-grey-900 mB-20">Add Project</h5>
				<form action="{{ route('admin.projects.store', $project) }}" method="POST" class="mB-20" enctype="multipart/form-data">
					{{ csrf_field() }}
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
						<label class="text-normal text-dark">Photos</label>
						<div id="photo" class="dropzone"></div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name" class="text-normal text-dark">Project Name</label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
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
									<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4">
							<label for="architect" class="text-normal text-dark">Architect</label>
							<input type="text" class="form-control" name="architect" value="{{ old('architect') }}" required>
						</div>
						<div class="col-md-4">
							<label for="location" class="text-normal text-dark">Location</label>
							<input type="text" class="form-control" name="location" value="{{ old('location') }}" required>
						</div>
						<div class="col-md-4">
							<label for="name" class="text-normal text-dark">Date</label>
							<input id="project-date" type="text" class="form-control" name="date" value="{{ old('date') }}" required>
						</div>
					</div>
					<button class="btn btn-primary mR-20">Add</button>
					<a href="{{ route('admin.projects.destroy', $project) }}" class="btn btn-danger"
					onclick="event.preventDefault(); document.getElementById('cancel-project').submit();">Cancel</a>
				</form>
				<form id="cancel-project" action="{{ route('admin.projects.destroy', $project) }}" method="POST" display="hidden">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@include('admin.projects.partials.upload')
@endsection
