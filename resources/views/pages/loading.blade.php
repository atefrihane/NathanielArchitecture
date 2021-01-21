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
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">	

</head>
<body class="loading-page">
	<img src="{{ url('images/icons/loading-logo.gif') }}">
	<?php
	session(['loading' => 1]);
	?>
	<script>
		setTimeout(function() {
			location.reload(true);
		}, 5200)
	</script>
</body>
</html>