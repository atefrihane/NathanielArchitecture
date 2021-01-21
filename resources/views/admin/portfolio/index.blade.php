@extends('admin.layouts.main')

@section('admin.content')
	<h3 class="c-grey-900 mT-10 mB-30">Portfolio</h3>
	<div class="row">
		<div class="col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<h5 class="c-grey-900 mB-20">Portfolio Photos (Drag and drop to sort the images)</h5>
				<ul id="sortable-project" class="list-unstyled">
					@foreach ($photos as $photo)
						<li class="sort-li" id="{{ $photo->id }}" style="margin-bottom: 10px;"><img src="{{ url('storage/photos/' . $photo->project->identifier . '/' . $photo->filename) }}" alt="" style="padding: 10px; border: 1px solid #ced4da; width: auto; height: 150px; object-fit:cover;"></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
		$(function() {
			$('#sortable-project').sortable({
				stop: function() {
					$.map($(this).find('.sort-li'), function(el) {
						var itemId = el.id;
						var itemIndex = $(el).index();

						$.ajax({
							url: '{{ route('admin.portfolio.sort') }}',
							type: 'POST',
							dataType: 'json',
							data: { itemId: itemId, itemIndex: itemIndex },
							headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content }
						});
					});
				}
			});
		});
	</script>
@endsection