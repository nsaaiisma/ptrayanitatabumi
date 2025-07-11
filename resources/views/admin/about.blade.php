@extends('layouts.admin')
@section('title')
About
@endsection

@section('content')
<div id="about-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">About Management</h2>
				<button onclick="openModal('modal-addAbout')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
					<i class="fas fa-plus mr-2"></i> Add About
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Actions</th>
						</tr>
					</thead>
					<tbody id="about-table-body" class="bg-white divide-y divide-gray-200">
						@foreach ($abouts as $about)
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $about->title }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $about->years }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $about->description }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<div class="flex justify-center text-center space-x-4">
									<button class="text-blue-600 hover:text-blue-900" onclick="editAbout(this, '{{ $about->encrypted_id }}', '{{ $about->title }}', '{{ $about->years }}', '{{ $about->description }}')">
										<i class="fas fa-edit"></i> Edit
									</button>
									<button class="text-red-600 hover:text-red-900" onclick="confirmDeleteAbout('{{ $about->encrypted_id }}', '{{ $about->title }}')">
										<i class="fas fa-trash"></i> Delete
									</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add About -->
<div id="modal-addAbout" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Add About</h3>
			<button onclick="closeModal('modal-addAbout')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.about.add')}}" method="post">
			<div class="p-4">
				@csrf
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="title" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="years" class="block text-sm font-medium text-gray-700">Years</label>
					<input type="text" name="years" id="years" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-addAbout')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal edit About -->
<div id="modal-editAbout" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit About</h3>
			<button onclick="closeModal('modal-editAbout')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form id="editAboutForm" action="{{ route('admin.about.edit')}}" method="post">
			<div class="p-4">
				@csrf
				<input type="hidden" name="id" id="edit-id">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="edit-title" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="years" class="block text-sm font-medium text-gray-700">Years</label>
					<input type="text" name="years" id="edit-years" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="edit-description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editAbout')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

@endsection
@section('script')
<script>
	function editAbout(button, id, title, years, description) {
		const $btn = $(button);
		const $form = $('#editAboutForm');

		$form.trigger('reset');

		$form.find('#edit-id').val(id);
		$form.find('#edit-title').val(title);
		$form.find('#edit-years').val(years);
		$form.find('#edit-description').val(description);

		openModal('modal-editAbout');
	}

	function confirmDeleteAbout(encryptedId, name) {
		Swal.fire({
			title: 'Yakin ingin menghapus ' + name + ' ?',
			text: "Data tidak dapat dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Ya, hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "{{ route('admin.about.delete') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						id: encryptedId
					},
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire('Berhasil Hapus About!', response.message, 'success').then(() => {
								location.reload(); // reload atau update table
							});
						} else {
							Swal.fire('Gagal Hapus About!', response.message, 'error');
						}
					},
					error: function(xhr) {
						Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
					}
				});
			}
		});
	}
</script>
@endsection