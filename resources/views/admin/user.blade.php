@extends('layouts.admin')
@section('title')
User
@endsection

@section('content')
<div id="settings-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">User</h2>
				<button onclick="openModal('modal-addUser')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
					<i class="fas fa-plus mr-2"></i> Add
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
							<th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
						</tr>
					</thead>
					<tbody id="settings-table-body" class="bg-white divide-y divide-gray-200">
						@foreach ($users as $user)
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $user->name }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $user->username }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $user->email }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $user->role }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">
								<div class="flex justify-center text-center space-x-4">
									<button class="text-blue-600 hover:text-blue-900" onclick="editUser(this, '{{ $user->encrypted_id }}', '{{ $user->name }}', '{{ $user->username }}', '{{ $user->email }}', '{{ $user->role }}')">
										<i class="fas fa-edit"></i> Edit
									</button>
									@if ($user->id !== auth()->id())
									<button class="text-red-600 hover:text-red-900" onclick="confirmDeleteUser('{{ $user->encrypted_id }}', '{{ $user->name }}')">
										<i class="fas fa-trash"></i> Delete
									</button>
									@endif
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


<!-- Modal Add User -->
<div id="modal-addUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Add User</h3>
			<button onclick="closeModal('modal-addUser')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.user.add')}}" method="post">
			<div class="p-4">
				@csrf
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="username" class="block text-sm font-medium text-gray-700">Username</label>
					<input type="text" name="username" id="username" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="password" class="block text-sm font-medium text-gray-700">Password</label>
					<input type="password" name="password" id="password" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
					<input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="role" class="block text-sm font-medium text-gray-700">Role</label>
					<select name="role" class="mt-1 p-2 border border-gray-300 rounded-md w-full" id="">
						<option value="0">Select Role</option>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-addUser')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal edit User -->
<div id="modal-editUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-md">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit User</h3>
			<button onclick="closeModal('modal-editUser')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form id="editUserForm" action="{{ route('admin.user.edit')}}" method="post">
			<div class="p-4">
				@csrf
				<input type="hidden" name="id" id="edit-id">
				<div class="mb-4">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input type="text" name="name" id="edit-name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="username" class="block text-sm font-medium text-gray-700">Username</label>
					<input type="text" name="username" id="edit-username" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="password" class="block text-sm font-medium text-gray-700">Password</label>
					<input type="password" name="password" id="edit-password" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
					<span class="text-xs text-gray-500">Don't fill if don't want to change</span>
				</div>
				<div class="mb-4">
					<label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
					<input type="email" name="email" id="edit-email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="role" class="block text-sm font-medium text-gray-700">Role</label>
					<select name="role" id="edit-role" class="mt-1 p-2 border border-gray-300 rounded-md w-full" id="">
						<option value="0">Select Role</option>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editUser')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>

@endsection
@section('script')
<script>
	function editUser(button, id, name, username, email, role) {
		const $btn = $(button);
		const $form = $('#editUserForm');

		$form.trigger('reset');

		$form.find('#edit-id').val(id);
		$form.find('#edit-name').val(name);
		$form.find('#edit-username').val(username);
		$form.find('#edit-email').val(email);
		$form.find('#edit-role').val(role).change();

		openModal('modal-editUser');
	}

	function confirmDeleteUser(encryptedId, name) {
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
					url: "{{ route('admin.user.delete') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						id: encryptedId
					},
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire('Berhasil Hapus User!', response.message, 'success').then(() => {
								location.reload(); // reload atau update table
							});
						} else {
							Swal.fire('Gagal Hapus User!', response.message, 'error');
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