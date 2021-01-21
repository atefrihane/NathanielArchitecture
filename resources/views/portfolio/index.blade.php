@extends('layouts.main')

@section('page.title')
	Portfolio | Architectural Photography by London based Nathaniel McMahon
@endsection

@section('content')
	<div id="main-div" class="main">
		<div id="main-slider" class="main-slider">
			<div class="slider" id="slidebox">
				<div class="slider-pages">
					@foreach ($photos as $photo)
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
	<div id="portfolio-mobile" class="portfolio-page-mobile">
		@foreach ($photos as $photo)
			<img src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}">
			<a href="/projects/{{ $photo->project->slug }}">
				<p>{{ $photo->project->name }}</p>
				<p>{{ $photo->project->architect }}</p>
				<p>{{ $photo->project->location }}</p>
				<p>{{ $photo->project->date->toFormattedDateString() }}</p>
			</a>
		@endforeach
	</div>
	<div class="info-pdf">
		<img src="{{ url('images/icons/info.svg') }}" alt="image-info">
	</div>
@endsection

@section('scripts')
	@include('partials.scripts.portfolio')
@endsection