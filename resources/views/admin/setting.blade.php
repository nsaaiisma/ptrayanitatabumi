@extends('layouts.admin')
@section('title')
Setting
@endsection

@section('content')
<div id="settings-section">
	<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Product</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-editProduct" data-id="{{ $setting->encrypted_id }}" data-title="{{ $setting->captionProduct }}" data-description="{{ $setting->descriptionProduct }}" onclick="editProductTitle(this)">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="table-auto w-full">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/3">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->captionProduct }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->descriptionProduct }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Portofolio</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-editPortofolio" data-id="{{ $setting->encrypted_id }}" data-title="{{ $setting->captionPortofolio }}" data-description="{{ $setting->descriptionPortofolio }}" onclick="editPortofolioTitle(this)">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="table-auto w-full">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/3">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->captionPortofolio }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->descriptionPortofolio }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">About</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-editAbout" data-id="{{ $setting->encrypted_id }}" data-title="{{ $setting->captionAboutMe }}" data-description="{{ $setting->descriptionAboutMe }}" data-ownerdescription="{{ $setting->owner_description }}" onclick="editAboutTitle(this)">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="table-auto w-full">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/3">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner Image</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner Description</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->captionAboutMe }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->descriptionAboutMe }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<img src="{{ asset('storage/' . $setting->owner_image) }}" class="w-12" alt="">
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->owner_description }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Testimoni</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-editTestimoni" data-id="{{ $setting->encrypted_id }}" data-title="{{ $setting->captionTestimoni }}" data-description="{{ $setting->descriptionTestimoni }}" onclick="editTestimoniTitle(this)">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="table-auto w-full">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/3">Title</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->captionTestimoni }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $setting->descriptionTestimoni }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Structure -->

<!-- Modal Product Title -->
<div id="modal-productTitle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-productTitle')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.setting.update')}}" method="post">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="productId" class="hidden">
				<input type="text" name="tipe" id="tipe" class="hidden" value="product">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="productTitle" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="productDescription" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-productTitle')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal Portofolio Title -->
<div id="modal-portofolioTitle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-portofolioTitle')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.setting.update')}}" method="post">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="portofolioId" class="hidden">
				<input type="text" name="tipe" id="tipe" class="hidden" value="portofolio">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="portofolioTitle" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="portofolioDescription" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-portofolioTitle')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal About Title -->
<div id="modal-aboutTitle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-aboutTitle')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="aboutId" class="hidden">
				<input type="text" name="tipe" id="tipe" class="hidden" value="about">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="aboutTitle" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="aboutDescription" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<img id="image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="ownerImage" class="block text-sm font-medium text-gray-700">Owner Image</label>
					<input type="file" name="ownerImage" id="ownerImage" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="ownerDescription" class="block text-sm font-medium text-gray-700">Owner Description</label>
					<textarea name="ownerDescription" id="aboutOwnerDescription" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-aboutTitle')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal Testimoni Title -->
<div id="modal-testimoniTitle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-testimoniTitle')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.setting.update')}}" method="post">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="testimoniId" class="hidden">
				<input type="text" name="tipe" id="tipe" class="hidden" value="testimoni">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" name="title" id="testimoniTitle" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="testimoniDescription" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-testimoniTitle')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')

<script>
	function editProductTitle(button) {
		const $btn = $(button);
		const id = $btn.data('id');
		const title = $btn.data('title');
		const description = $btn.data('description');

		$('#productId').val(id);
		$('#productTitle').val(title);
		$('#productDescription').val(description);

		openModal('modal-productTitle');
	}

	function editPortofolioTitle(button) {
		const $btn = $(button);
		const id = $btn.data('id');
		const title = $btn.data('title');
		const description = $btn.data('description');

		$('#portofolioId').val(id);
		$('#portofolioTitle').val(title);
		$('#portofolioDescription').val(description);

		openModal('modal-portofolioTitle');
	}

	// Preview Image
	$('#ownerImage').on('change', function() {
		const file = this.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				$('#image-preview').attr('src', e.target.result).removeClass('hidden');
			};
			reader.readAsDataURL(file);
		}
	});

	function editAboutTitle(button) {
		const $btn = $(button);
		const id = $btn.data('id');
		const title = $btn.data('title');
		const description = $btn.data('description');
		const ownerDescription = $btn.data('ownerdescription');

		$('#aboutId').val(id);
		$('#aboutTitle').val(title);
		$('#aboutDescription').val(description);
		$('#aboutOwnerDescription').val(ownerDescription);

		openModal('modal-aboutTitle');
	}

	function editTestimoniTitle(button) {
		const $btn = $(button);
		const id = $btn.data('id');
		const title = $btn.data('title');
		const description = $btn.data('description');

		$('#testimoniId').val(id);
		$('#testimoniTitle').val(title);
		$('#testimoniDescription').val(description);

		openModal('modal-testimoniTitle');
	}
</script>
@endsection