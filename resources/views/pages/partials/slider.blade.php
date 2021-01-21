<section id="main-slider" class="scrollingpage scrollingpage-index main-slider">
	<div class="slider" id="slidebox">
		<div class="slider-pages">
			@foreach ($slides as $slide)
				<div class="slider-page">
					<img src="{{ url('storage/photos/' . $slide->project->identifier . '/' . $slide->filename) }}">
				</div>
			@endforeach
			<div data-slide-to="prev" class="slider-prev"></div>
			<div data-slide-to="next" class="slider-next"></div>
		</div>
	</div>
</section>