@extends('admin.layouts.main')

@section('admin.content')
	<div class="peers ai-c jc-sb fxw-nw mT-10 mB-30">
		<div class="peer">
			<h3 class="c-grey-900 mB-0">Projects</h3>
		</div>
		<div class="peer">
			<a href="{{ route('admin.projects.create.start') }}" class="btn btn-primary">Add Project</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				@if (count($projects))
					<h5 class="c-grey-900 mB-20">List of Projects</h5>
					<table id="datatable" class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Architect</th>
								<th>Location</th>
								<th>Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $project)
								<tr>
									<td>{{ $project->id }}</td>
									<td>{{ $project->name }}</td>
									<td>{{ $project->architect }}</td>
									<td>{{ $project->location }}</td>
									<td>{{ $project->date->toFormattedDateString() }}</td>
									<td>
										<ul class="list-inline">
											<li class="list-inline-item">
												<a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-info btn-sm">
													<i class="ti-pencil"></i>
												</a>
											</li>
											<li class="list-inline-item">
												<form onsubmit="return confirm('Are you sure you want to delete this project? Doing this will also remove the photos associated with this project.')" action="{{ route('admin.projects.destroy', $project) }}" method="POST" display="hidden">
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
					<h6 class="c-grey-900 mT-10 mB-10">There are currently no projects in the database.</h6>
				@endif
			</div>
		</div>
	</div>
@endsection