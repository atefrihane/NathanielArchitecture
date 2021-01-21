@extends('auth.layouts.main')

@section('auth.content')
	<h4 class="fw-300 c-grey-900 mB-400">Register</h4>
	<form class="form-horizontal" method="POST" action="{{ route('register') }}">
		{{ csrf_field() }}
		@if (count($errors))
			<div class="alert alert-danger" role="alert">
				<ul class="list-unstyled">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="form-group">
			<label for="name" class="text-normal text-dark">Name</label>
			<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
		</div>
		<div class="form-group">
			<label for="email" class="text-normal text-dark">Email</label>
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
		</div>
		<div class="form-group">
			<label for="password" class="text-normal text-dark">Password</label>
			<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
		</div>
		<div class="form-group">
			<label for="password_confirmation" class="text-normal text-dark">Confirm Password</label>
			<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
		</div>
		<div class="form-group">
			<div class="peers ai-c jc-sb fxw-nw">
				<div class="peer">
					<a href="{{ route('login') }}">I have an account</a>
				</div>
				<div class="peer">
					<button class="btn btn-primary">Register</button>
				</div>
			</div>
		</div>
	</form>
@endsection
