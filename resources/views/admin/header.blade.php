@extends('layouts.admin')
@section('title')
Header
@endsection

@section('content')
<div id="header-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Header Management</h2>

				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-edit" onclick="editHeader(this, '{{ $header->encrypted_id }}', '{{ $header->heading }}', '{{ $header->subheading }}', '{{ $header->description }}')">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">sub-title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">description</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">image-background</th>
						</tr>
					</thead>
					<tbody id="header-table-body" class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<img src="{{ asset($header->logo ? '/storage/' . $header->logo : 'images/img-logo.png') }}" class="w-12 rounded-full" alt="logo aplikasi">
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $header->heading }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $header->subheading }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $header->description }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<img src="{{ asset($header->image ? '/storage/' . $header->image : 'images/img-header.png') }}" class="w-12 h-12" alt="header aplikasi">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit heading -->
<div id="modal-editHeader" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-editHeader')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.header.edit')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="hidden" name="id" id="edit-id">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="title" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="sub-title" class="block text-sm font-medium text-gray-700">Subtitle</label>
					<input type="text" name="sub-title" id="sub-title" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<img id="logo-preview" src="#" alt="Logo Preview" class="mb-2 hidden h-24">
					<label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
					<input type="file" name="logo" id="logo" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>

				<div class="mb-4">
					<img id="image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="image" class="block text-sm font-medium text-gray-700">Image-background</label>
					<input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editHeader')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		// Preview Logo
		$('#logo').on('change', function() {
			const file = this.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					$('#logo-preview').attr('src', e.target.result).removeClass('hidden');
				};
				reader.readAsDataURL(file);
			}
		});

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
	});

	function editHeader(button, id, title, subtitle, description) {
		const $btn = $(button);
		console.log(id);
		$('#edit-id').val(id);
		$('#title').val(title);
		$('#sub-title').val(subtitle);
		$('#description').val(description);

		openModal('modal-editHeader');
	}
</script>
@endsection