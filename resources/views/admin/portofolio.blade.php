@extends('layouts.admin')
@section('title')
Portofolio
@endsection

@section('content')
<div id="portofolio-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Portofolio Management</h2>
				<button onclick="openModal('modal-addPortofolio')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
					<i class="fas fa-plus mr-2"></i> Add Portfolio
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Years</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Action</th>
						</tr>
					</thead>
					<tbody id="portfolio-table-body" class="bg-white divide-y divide-gray-200">
						@foreach ($portofolios as $portofolio)
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $portofolio->name }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $portofolio->description }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $portofolio->location }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $portofolio->timeRange }} Bulan</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $portofolio->years }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<img src="{{ asset('storage/' . $portofolio->image) }}" class="w-12 h-12" alt="portofolio {{ $portofolio->name }}">
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded-md w-full status-select" data-id="{{ $portofolio->encrypted_id }}">
									<option value="finished" {{ $portofolio->status == 'finished' ? 'selected' : '' }}>Finished</option>
									<option value="unfinished" {{ $portofolio->status == 'unfinished' ? 'selected' : '' }}>Unfinished</option>
								</select>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<div class="flex justify-center text-center space-x-4">
									<button class="text-blue-600 hover:text-blue-900" onclick="editPortofolio(this, '{{ $portofolio->encrypted_id }}', '{{ $portofolio->name }}', '{{ $portofolio->description }}', '{{ $portofolio->location }}', '{{ $portofolio->timeRange }}', '{{ $portofolio->years }}')">
										<i class="fas fa-edit"></i> Edit
									</button>
									<button class="text-red-600 hover:text-red-900" onclick="confirmDeletePortofolio('{{ $portofolio->encrypted_id }}', '{{ $portofolio->name }}')">
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

<!-- Modal Add Portofolio -->
<div id="modal-addPortofolio" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Add Portofolio</h3>
			<button onclick="closeModal('modal-addPortofolio')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.portofolio.add')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">Location</label>
					<textarea name="location" id="location" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="time" class="block text-sm font-medium text-gray-700">Time</label>
					<div class="flex rounded-md border border-gray-300 ">
						<input type="number" name="time" id="time" class="p-2 flex-1 block w-full rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
						<span class="inline-flex items-center px-3 rounded-r-md bg-gray-100 text-gray-500 text-sm">
							Bulan
						</span>
					</div>
					<span class="text-xs text-gray-500">Only Number</span>
				</div>
				<div class="mb-4">
					<label for="years" class="block text-sm font-medium text-gray-700">Years</label>
					<input type="number" name="years" id="years" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					<span class="text-xs text-gray-500">Only Number</span>
				</div>
				<div class="mb-4">
					<img id="image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="image" class="block text-sm font-medium text-gray-700">Image</label>
					<input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-addPortofolio')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal edit Portofolio -->
<div id="modal-editPortofolio" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Portofolio</h3>
			<button onclick="closeModal('modal-editPortofolio')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form id="editPortofolioForm" action="{{ route('admin.portofolio.edit')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="hidden" name="id" id="edit-id">
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="edit-name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="edit-description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">Location</label>
					<textarea name="location" id="edit-location" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="time" class="block text-sm font-medium text-gray-700">Time</label>
					<div class="flex rounded-md border border-gray-300 ">
						<input type="number" name="time" id="edit-time" class="p-2 flex-1 block w-full rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
						<span class="inline-flex items-center px-3 rounded-r-md bg-gray-100 text-gray-500 text-sm">
							Bulan
						</span>
					</div>
					<span class="text-xs text-gray-500">Only Number</span>
				</div>
				<div class="mb-4">
					<label for="years" class="block text-sm font-medium text-gray-700">Years</label>
					<input type="number" name="years" id="edit-years" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					<span class="text-xs text-gray-500">Only Number</span>
				</div>
				<div class="mb-4">
					<img id="edit-image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="image" class="block text-sm font-medium text-gray-700">Image</label>
					<input type="file" name="image" id="edit-image" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editPortofolio')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

@endsection
@section('script')
<script>
	$(document).ready(function() {
		// Preview Image
		$('#image').on('change', function() {
			const file = this.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					$('#image-preview').attr('src', e.target.result).removeClass('hidden');
				};
				reader.readAsDataURL(file);
			}
		});
		// Preview Image Edit
		$('#edit-image').on('change', function() {
			const file = this.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					$('#edit-image-preview').attr('src', e.target.result).removeClass('hidden');
				};
				reader.readAsDataURL(file);
			}
		});

		$('.status-select').on('change', function() {
			let status = $(this).val();
			let id = $(this).data('id');

			$.ajax({
				url: "{{ route('admin.portofolio.status') }}",
				method: 'POST',
				data: {
					_token: '{{ csrf_token() }}',
					id: id,
					status: status
				},
				success: function(response) {
					console.log(response);
					if (response.status === 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: response.message,
							timer: 1500,
							showConfirmButton: false
						});
					} else {
						Swal.fire('Gagal!', response.message, 'error');
					}
				},
				error: function() {
					Swal.fire('Error!', 'Gagal menyimpan status.', 'error');
				}
			});
		});
	});

	function editPortofolio(button, id, name, description, location, time, years) {
		const $btn = $(button);
		const $form = $('#editPortofolioForm');

		$form.trigger('reset');

		$form.find('#edit-id').val(id);
		$form.find('#edit-name').val(name);
		$form.find('#edit-description').val(description);
		$form.find('#edit-location').val(location);
		$form.find('#edit-time').val(time);
		$form.find('#edit-years').val(years);

		openModal('modal-editPortofolio');
	}

	function confirmDeletePortofolio(encryptedId, name) {
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
					url: "{{ route('admin.portofolio.delete') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						id: encryptedId
					},
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire('Berhasil Hapus Portofolio!', response.message, 'success').then(() => {
								location.reload(); // reload atau update table
							});
						} else {
							Swal.fire('Gagal Hapus Portofolio!', response.message, 'error');
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