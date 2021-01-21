@extends('layouts.main')

@section('page.title')
	Nathaniel McMahon | {{ $project->architect }} - {{ $project->name }} 
@endsection

@section('content')
	<div id="main-div" class="main">
		<div id="main-slider" class="main-slider">
			<div class="slider" id="slidebox">
				<div class="slider-pages">
					@foreach ($project->photos as $photo)
						<div class="slider-page">
							<img src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}" class="ca-img">
						</div>
					@endforeach
					<div data-slide-to="prev" class="slider-prev"></div>
					<div data-slide-to="next" class="slider-next"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="project-mobile" class="project-page-mobile">
		@foreach ($project->photos as $photo)
			<img src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}">
		@endforeach
	</div>
	<div class="info-pdf">
		<img src="{{ url('images/icons/info.svg') }}" alt="image-info">
	</div>
@endsection

@section('scripts')
	@include('partials.scripts.project')
@endsection