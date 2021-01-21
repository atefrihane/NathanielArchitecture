<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
	<link href="{{ mix('/css/backend.css') }}" rel="stylesheet"> 
</head>

<body class="app">
    @include('partials.spinner')
    <div>
        @include('admin.partials.sidebar')
        <div class="page-container">
            @include('admin.partials.topbar')
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">
						@include('admin.partials.messages')
						@yield('admin.content')
                    </div>
                </div>
            </main>
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright &copy; {{ date('Y') }} Nathaniel McMahon. All rights reserved.</span>
            </footer>
        </div>
	</div>
	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>