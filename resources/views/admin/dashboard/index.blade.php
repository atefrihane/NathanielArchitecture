@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Dashboard</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5>Projects</h5>
				<p>The projects section is fairly straightforward, you basically use this to add projects to the website. There is the option of also editing a specific project information. To remove photos from the project you have to visit the photos page and remove the photos from there.</p>
				<p><strong>Total Projects:</strong> {{ $projects }}</p>
				<a href="{{ route('admin.projects.create.start') }}" class="btn btn-primary mR-20">Add Project</a>
				<a href="{{ route('admin.projects.index') }}" class="btn btn-info">View Projects</a>
			</div>
		</div>
		<div class="col-md-6">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5>Photos</h5>
				<p>If you want to add a photo to the homepage slider or the portfolio page, just visit the Photos page via the button below, search for a photo and in the edit form you can select wether you want to add to the slider, portfolio or both.</p>
				<p><strong>Total Photos:</strong> {{ $photos }}</p>
				<a href="{{ route('admin.photos.index') }}" class="btn btn-info">View Photos</a>
			</div>
		</div>
		<div class="col-md-6">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5>Tags</h5>
				<p>The tags are simply a way to categorize the projects and also a way for visitors to filter the projects in the frontend. You can add new tags or delete existing ones. It's not recommended that you delete tags that have projects associated. In the tags section you can check the amount of projects each tag has associated.</p>
				<p><strong>Total Tags:</strong> {{ $tags }}</p>
				<a href="{{ route('admin.tags.index') }}" class="btn btn-info">View Tags</a>
			</div>
		</div>
		<div class="col-md-6">
				<div class="bgc-white bd bdrs-3 p-20 mB-20">
					<h5>Portfolio</h5>
					<p>In this section it's possible to change the order of the images displayed on the portfolio page of the main website.</p>
					<a href="{{ route('admin.portfolio.index') }}" class="btn btn-info">Manage Portfolio</a>
				</div>
			</div>
	</div>
@endsection