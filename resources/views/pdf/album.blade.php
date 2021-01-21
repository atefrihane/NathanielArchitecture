<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Nathaniel McMahon Photo Album</title>
</head>
<style>
	body {
		font-family: 'Hind', sans-serif;
		color: #313435;
	}

	@page {
		footer: page-footer;
	}

	@page :first {
		footer: first-footer;
	}

	* {
		font-family: sans-serif;
	}

	.page-wrapper {
		color: #313435;
		max-height: 100%;
		height: 100%;
	}

	.image-wrapper {
		text-align: center;
		width: 100%;
	}
</style>
<body>
	<div class="page-wrapper" style="text-align: center; padding-top: 210px;">
		<img src="{{ url('images/icons/logo.svg') }}" style="height: 70px; width: auto; padding-bottom: 20px;">
		<h1>Nathaniel McMahon | Architectural Photography</h1>
	</div>
	@foreach ($photos as $photo)
		<div class="page-wrapper">
			<div class="image-wrapper">
				<img class="full-image" src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}">
			</div>
		</div>
	@endforeach
	<htmlpagefooter name="page-footer">
		<p style="text-align:center; color: #72777a;">Nathaniel McMahon Architectural photographer &copy; 2018 | User curated portfolio</p>
	</htmlpagefooter>
	<htmlpagefooter name="first-footer">
	</htmlpagefooter>
</body>
</html>