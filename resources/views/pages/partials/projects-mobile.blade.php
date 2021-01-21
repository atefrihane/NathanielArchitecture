<div id="mobile-projects-section" class="mobile-projects-section">
	@foreach ($projects as $project)
		<img src="{{ url('storage/thumbs/' . $project->id . '.jpg') }}">
		<a href="/projects/{{ $project->slug }}">
			<p>{{ $project->name }}</p>
			<p>{{ $project->architect }}</p>
			<p>{{ $project->location }}</p>
			<p>{{ $project->date->toFormattedDateString() }}</p>
		</a>
	@endforeach
</div>