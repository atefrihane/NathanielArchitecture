@extends('layouts.main')

@section('content')
	<div id="main-div" class="main" onresize="location.reload();">
		@include('pages.partials.slider')
		@include('pages.partials.projects')
		@include('pages.partials.about')
	</div>
	{{-- <div class="mobile-main">
		@include('pages.partials.slider-mobile')
		@include('pages.partials.projects-mobile')
		@include('pages.partials.about-mobile')
	</div> --}}
@endsection

@section('scripts')
	@include('partials.scripts.gallery')
	@include('partials.scripts.main')
@endsection