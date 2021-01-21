@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Photos</h3>
	<div class="row">
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				@if (count($photos))
					<h5 class="c-grey-900 mB-20">List of Projects</h5>
					<table id="datatable" class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Photo</th>
								<th>Project</th>
								<th>Slider</th>
								<th>Portfolio</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($photos as $photo)
								<tr>
									<td>{{ $photo->id }}</td>
									<td>
										<img class="datatable-image" src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}" alt="{{ $photo->project->name }}">
										{{ $photo->filename }}
									</td>
									<td>{{ $photo->project->name }}</td>
									<td>{{ ($photo->slider) ? '✔' : '✖' }}</td>
									<td>{{ ($photo->portfolio) ? '✔' : '✖' }}</td>
									<td>
										<ul class="list-inline">
											<li class="list-inline-item">
												<a href="{{ route('admin.photos.edit', $photo) }}" class="btn btn-info btn-sm">
													<i class="ti-pencil"></i>
												</a>
											</li>
											<li class="list-inline-item">
												<form onsubmit="return confirm('Are you sure you want to delete this photo?')" action="{{ route('admin.photos.destroy', $photo) }}" method="POST" display="hidden">
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
					<h6 class="c-grey-900 mT-10 mB-10">There are currently no photos in the database. Create a project and upload photos to a project.</h6>
				@endif
			</div>
		</div>
	</div>
@endsection