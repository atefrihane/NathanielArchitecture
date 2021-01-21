@extends('auth.layouts.main')

@section('auth.content')
	<h4 class="fw-300 c-grey-900 mB-400">Login</h4>
	<form class="form-horizontal" method="POST" action="{{ route('login') }}">
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
			<label for="email" class="text-normal text-dark">Email</label>
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
		</div>
		<div class="form-group">
			<label for="password" class="text-normal text-dark">Password</label>
			<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
		</div>
		<div class="form-group">
			<div class="peers ai-c jc-sb fxw-nw">
				<div class="peer">
					<div class="checkbox checkbox-circle checkbox-info peers ai-c">
						<input type="checkbox" id="remember" name="remember" class="peer" {{ old('remember') ? 'checked' : '' }}>
						<label for="remember" class="peers peer-greed js-sb ai-c">
							<span class="peer peer-greed">Remember Me</span>
						</label>
					</div>
				</div>
				<div class="peer">
					<button class="btn btn-primary">Login</button>
				</div>
			</div>
		</div>
	</form>
@endsection
