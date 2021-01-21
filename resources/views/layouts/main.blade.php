<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	@hasSection('page.title')
        <title>@yield('page.title')</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">	
	@if (config('nathaniel.google_analytics.tracking_id') && 'production' === config('app.env'))
        @include('tracking.analytics')
    @endif
</head>
<body id="projects" class="main">
	<div class="loader">
		<img src="{{ url('images/icons/loading-logo.gif') }}">
	</div>
	@yield('content')
	@include('partials.sidebar')
	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>
