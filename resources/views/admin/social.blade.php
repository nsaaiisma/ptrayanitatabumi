@extends('layouts.admin')
@section('title')
Social
@endsection

@section('content')
<div id="social-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Social Management</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-edit" onclick="editSocial(this, '{{$social->encrypted_id}}', '{{ $social->whatsapp }}', '{{ $social->instagram }}', '{{ $social->facebook }}', '{{ $social->youtube }}', '{{ $social->linkedin }}')">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Whatsapp</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instagram</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facebook</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Youtube</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Linked in</th>
						</tr>
					</thead>
					<tbody id="social-table-body" class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $social->whatsapp }}
								<br>
								<a href="{{ $social->whatsapp }}" target="_blank">
									<i class="fa-solid fa-arrow-up-right-from-square"></i>
								</a>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $social->instagram }}
								<br>
								<a href="{{ $social->instagram }}" target="_blank">
									<i class="fa-solid fa-arrow-up-right-from-square"></i>
								</a>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $social->facebook }}<br>
								<a href="{{ $social->facebook }}" target="_blank">
									<i class="fa-solid fa-arrow-up-right-from-square"></i>
								</a>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $social->youtube }}
								<br>
								<a href="{{ $social->youtube }}" target="_blank">
									<i class="fa-solid fa-arrow-up-right-from-square"></i>
								</a>
							</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $social->linkedin }}<br>
								<a href="{{ $social->linkedin }}" target="_blank">
									<i class="fa-solid fa-arrow-up-right-from-square"></i>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit heading -->
<div id="modal-editSocial" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-editSocial')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.social.edit')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="id" class="hidden">
				<div class="mb-4">
					<label for="whatsapp" class="block text-sm font-medium text-gray-700">Whatsapp</label>
					<input type="text" name="whatsapp" id="whatsapp" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="https://wa.me/6281234567890">
				</div>
				<div class="mb-4">
					<label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
					<input type="text" name="instagram" id="instagram" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="https://instagram.com/yourprofile">
				</div>
				<div class="mb-4">
					<label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
					<input type="text" name="facebook" id="facebook" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="https://facebook.com/yourpage">
				</div>
				<div class="mb-4">
					<label for="youtube" class="block text-sm font-medium text-gray-700">Youtube</label>
					<input type="text" name="youtube" id="youtube" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="https://youtube.com/yourchannel">
				</div>
				<div class="mb-4">
					<label for="linkedin" class="block text-sm font-medium text-gray-700">Linked In</label>
					<input type="text" name="linkedin" id="linkedin" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="https://linkedin.com/in/yourprofile">
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editSocial')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')
<script>
	function editSocial(button, id, whatsapp, instagram, facebook, youtube, linkedin) {
		const $btn = $(button);

		$('#id').val(id);
		$('#whatsapp').val(whatsapp);
		$('#instagram').val(instagram);
		$('#facebook').val(facebook);
		$('#youtube').val(youtube);
		$('#linkedin').val(linkedin);

		openModal('modal-editSocial');
	}
</script>
@endsection