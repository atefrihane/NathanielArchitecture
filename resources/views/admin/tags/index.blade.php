@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Tags</h3>
	<div class="row">
		<div class="col-md-8">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				@if (count($tags))
					<h5 class="c-grey-900 mB-20">List of Tags</h5>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th># of Projects</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tags as $tag)
								<tr>
									<td>{{ $tag->id }}</td>
									<td>{{ $tag->name }}</td>
									<td>{{ $tag->projects_count }}</td>
									<td>
										<ul class="list-inline">
											<li class="list-inline-item">
											<form onsubmit="return confirm('Are you sure you want to delete this tag?')" action="{{ route('admin.tags.destroy', $tag) }}" method="POST" display="hidden">
													{{ method_field('DELETE') }}
													{{ csrf_field() }}
													<button class="btn btn-danger btn-sm">
														<i class="ti-trash"></i>
													</button>
												</form>
											</li>
										</ul>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<h6 class="c-grey-900 mT-10 mB-10">There are currently no tags in the database.</h6>
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<form class="form-horizontal" action="{{ route('admin.tags.store') }}" method="POST">
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
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
					</div>
					<button class="btn btn-primary">Add</button>
				</form>
			</div>
		</div>
	</div>
@endsection