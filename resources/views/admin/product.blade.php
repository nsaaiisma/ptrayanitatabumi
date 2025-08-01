@extends('layouts.admin')
@section('title')
Product
@endsection

@section('content')
<div id="product-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Product Management</h2>
				<button onclick="openModal('modal-addProduct')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
					<i class="fas fa-plus mr-2"></i> Add Product
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Theme</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Action</th>
						</tr>
					</thead>
					<tbody id="product-table-body" class="bg-white divide-y divide-gray-200">
						@foreach ($products as $product)
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->name }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->category }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->description }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->price }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->location }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->size }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $product->theme }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12" alt="product {{ $product->name }}">
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded-md w-full status-select" data-id="{{ $product->encrypted_id }}">
									<option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
									<option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
								</select>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<div class="flex justify-center text-center space-x-4">
									<button class="text-green-600 hover:text-green-900" onclick="detailProduct(this, '{{$product->name}}', '{{$product->category}}', '{{$product->description}}', '{{$product->price}}', '{{$product->location}}', '{{$product->size}}', '{{$product->theme}}', '{{$product->imageUrl}}', '{{$product->status}}')">
										<i class="fas fa-eye"></i> Detail
									</button>
									<button class="text-blue-600 hover:text-blue-900" onclick="editProduct(this, '{{$product->encrypted_id}}', '{{$product->name}}', '{{$product->category}}', '{{$product->description}}', '{{$product->price}}', '{{$product->location}}', '{{$product->size}}', '{{$product->theme}}')">
										<i class="fas fa-edit"></i> Edit
									</button>
									<button class="text-red-600 hover:text-red-900" onclick="confirmDeleteProduct('{{ $product->encrypted_id }}', '{{ $product->name }}')">
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

<!-- Product Modal -->
<div id="modal-productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
		<!-- Modal Header -->
		<div class="flex justify-between items-center p-4 border-b border-gray-200">
			<h3 class="text-xl font-semibold text-gray-800">Product Details</h3>
			<button onclick="closeModal('modal-productModal')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>

		<!-- Modal Body -->
		<div class="p-6 overflow-y-auto max-h-[60vh]">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<!-- Product Image -->
				<div class="bg-gray-100 rounded-lg overflow-hidden" id="productImageContainer">
				</div>

				<!-- Product Details -->
				<div class="space-y-4">
					<!-- Basic Info -->
					<div class="space-y-2">
						<h2 id="productName" class="text-2xl font-bold text-gray-800"></h2>
						<div class="flex items-center">
							<span id="productCategory" class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded"></span>
							<span id="productStatus" class="ml-2 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded"></span>
						</div>
						<p id="productPrice" class="text-xl font-semibold text-blue-600"></p>
					</div>
					<!-- Details Grid -->
					<div class="grid grid-cols-2 gap-4">
						<div>
							<p class="text-sm text-gray-500">Location</p>
							<p id="productLocation" class="font-medium text-gray-700"></p>
						</div>
						<div class=""></div>
						<div>
							<p class="text-sm text-gray-500">Size</p>
							<p id="productSize" class="font-medium text-gray-700"></p>
						</div>
						<div>
							<p class="text-sm text-gray-500">Theme</p>
							<p id="productTheme" class="font-medium text-gray-700"></p>
						</div>
					</div>

					<!-- Description -->
					<div>
						<p class="text-sm text-gray-500">Description</p>
						<p id="productDescription" class="text-gray-700 mt-1 break-words whitespace-normal"></p>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Footer -->
		<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
			<button onclick="closeModal('modal-productModal')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
				Close
			</button>
		</div>
	</div>
</div>


<!-- Modal Add Product -->
<div id="modal-addProduct" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Add Product</h3>
			<button onclick="closeModal('modal-addProduct')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.product.add')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="category" class="block text-sm font-medium text-gray-700">Category</label>
					<input name="category" id="category" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="price" class="block text-sm font-medium text-gray-700">Price</label>
					<input type="text" name="price" id="price" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">Location</label>
					<input name="location" id="location" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="flex">
					<div class="mb-4 mr-4">
						<label for="size" class="block text-sm font-medium text-gray-700">Size</label>
						<input name="size" id="size" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					</div>
					<div class="mb-4">
						<label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
						<input name="theme" id="theme" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					</div>
				</div>
				<div class="mb-4">
					<img id="image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="image" class="block text-sm font-medium text-gray-700">Image</label>
					<input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-addProduct')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal edit Product -->
<div id="modal-editProduct" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Product</h3>
			<button onclick="closeModal('modal-editProduct')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form id="editProductForm" action="{{ route('admin.product.edit')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="hidden" name="id" id="edit-id">
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="edit-name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="category" class="block text-sm font-medium text-gray-700">Category</label>
					<input name="category" id="edit-category" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea name="description" id="edit-description" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="price" class="block text-sm font-medium text-gray-700">Price</label>
					<input name="price" id="edit-price" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">Location</label>
					<input name="location" id="edit-location" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="flex">
					<div class="mb-4 mr-4">
						<label for="size" class="block text-sm font-medium text-gray-700">Size</label>
						<input name="size" id="edit-size" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					</div>
					<div class="mb-4">
						<label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
						<input name="theme" id="edit-theme" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					</div>
				</div>
				<div class="mb-4">
					<img id="image-preview" src="#" alt="Background Image Preview" class="mb-2 hidden h-24">
					<label for="image" class="block text-sm font-medium text-gray-700">Image</label>
					<input type="file" name="edit-image" id="image" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editProduct')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')

<script>
	function detailProduct(button, name, category, description, price, location, size, theme, image, status) {
		const $btn = $(button);

		$('#productName').text(name);
		$('#productCategory').text(category);
		$('#productDescription').text(description);
		$('#productPrice').text(price);
		$('#productLocation').text(location);
		$('#productSize').text(size);
		$('#productTheme').text(theme);
		$('#productImage').attr('alt', name);
		$('#productStatus').text(status);
		$('#productImageContainer').html(`
    <img id="productImage" src="${image}" alt="${name}" class="w-full h-full object-cover">
`);
		openModal('modal-productModal');
	}


	function editProduct(button, id, name, category, description, price, location, size, theme) {
		const $btn = $(button);
		const $form = $('#editProductForm');

		$form.trigger('reset');

		$form.find('#edit-id').val(id);
		$form.find('#edit-name').val(name);
		$form.find('#edit-category').val(category);
		$form.find('#edit-description').val(description);
		$form.find('#edit-price').val(price);
		$form.find('#edit-size').val(size);
		$form.find('#edit-location').val(location);
		$form.find('#edit-theme').val(theme);

		openModal('modal-editProduct');
	}


	function confirmDeleteProduct(encryptedId, name) {
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
					url: "{{ route('admin.product.delete') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						id: encryptedId
					},
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire('Berhasil Hapus product!', response.message, 'success').then(() => {
								location.reload(); // reload atau update table
							});
						} else {
							Swal.fire('Gagal Hapus product!', response.message, 'error');
						}
					},
					error: function(xhr) {
						Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
					}
				});
			}
		});
	}
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
				url: "{{ route('admin.product.status') }}",
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
</script>

@endsection