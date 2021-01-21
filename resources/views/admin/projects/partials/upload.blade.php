<script>
	let drop = new Dropzone ('#photo', {
		addRemoveLinks: true,
		url: '{{ route('admin.photos.store', $project) }}',
		headers: {
			'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
		}
	});

    drop.on('success', function (project, response) {
        project.id = response.id
    })

    drop.on('removedfile', function (project) {
        axios.delete('/{{ $project->identifier }}/upload/' + project.id).catch(function (error) {
            drop.emit('addedfile', {
                id: project.id,
                name: project.name,
            })
        })
    })
</script>