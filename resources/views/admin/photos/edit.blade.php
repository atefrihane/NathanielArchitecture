@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Photos</h3>
	<div class="row">
		<div class="col-md-8">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5 class="c-grey-900 mB-20">Edit Photo ({{ $photo->filename }})</h5>
				<img class="edit-image" src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}" alt="{{ $photo->project->name }}">
			</div>
		</div>
		<div class="col-md-4">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h6 class="c-grey-900 mB-20">Use the controls to set this photo to be part of the slider, portfolio or both.</h6>
				<form action="{{ route('admin.photos.update', $photo) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<div class="form-group">
						<div class="checkbox checkbox-circle checkbox-info peers ai-c mB-10">
							<input type="checkbox" name="slider" class="peer" {{ $photo->slider ? 'checked' : '' }}>
							<label for="slider" class="peers peer-greed js-sb ai-c">
								<span class="peer peer-greed">Slider</span>
							</label>
						</div>
						<div class="checkbox checkbox-circle checkbox-info peers ai-c mB-20">
							<input type="checkbox" name="portfolio" class="peer" {{ $photo->portfolio ? 'checked' : '' }}>
							<label for="portfolio" class="peers peer-greed js-sb ai-c">
								<span class="peer peer-greed">Portfolio</span>
							</label>
						</div>
					</div>					
					<button class="btn btn-primary">Edit</button>
				</form>
			</div>
		</div>
	</div>
@endsection