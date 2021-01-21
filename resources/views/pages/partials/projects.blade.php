<section id="projects-section" class="scrollingpage scrollingpage-projects projects-section" allowfullscreen mozallowfullscreen webkitallowfullscreen>
	<div id="content">
		<div id="thumbs">
			<a class="prev-button" href="#" style="display: none;"></a>
			<a class="next-button" href="#" style="display: none;"></a>
			@foreach ($projects as $project)
		<div class="thumb" style="background-image: url({{ url('storage/thumbs/' . $project->id . '.jpg') }})" category="{{ implode(',', $project->tags->pluck('tag_id')->toArray()) }}" sarchitect="{{ str_slug($project->architect) }}" slocation="{{ str_slug($project->location) }}">
					<h3>
						<a href="/projects/{{ $project->slug }}">
							<span>
								<strong>{{ $project->name }}</strong>
								<em>{{ $project->architect }}</em>
								<em>{{ $project->location }}</em>
								<em>{{ $project->date->toFormattedDateString() }}</em>
							</span>
						</a>
					</h3>
				</div>
			@endforeach
		</div>
	</div>
</section>