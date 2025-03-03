<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('/css/backend.css') }}" rel="stylesheet">
</head>
<body class="app">
    @include('partials.spinner')
	<div class="peers ai-s fxw-nw h-100vh">
		<div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("/images/bg.jpg")'>
			<div class="pos-a centerXY">
				<div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
					<img class="pos-a centerXY" src="/images/logo.png" alt="Nathaniel McMahon">
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
			@yield('auth.content')
		</div>
	</div>
	<script src="{{ asset('/js/manifest.js') }}"></script>
	<script src="{{ asset('/js/vendor.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>