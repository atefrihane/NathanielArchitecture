<div class="mobile-main-slider">
	<ul class="list-unstyled" id="mobile-slider">
		@foreach ($slides as $slide)
			<li>
				<img src="{{ url('storage/photos/' . $slide->project->identifier . '/' . $slide->filename) }}">
			</li>
		@endforeach
	</ul>
</div>