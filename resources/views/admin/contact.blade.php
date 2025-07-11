@extends('layouts.admin')
@section('title')
Contact
@endsection

@section('content')
<div id="contact-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Contact Management</h2>
				<button class="text-blue-600 hover:text-blue-900 mr-4" id="btn-edit" onclick="editContact(this, '{{$contact->encrypted_id}}', '{{ $contact->location }}', '{{ $contact->telephone }}', '{{ $contact->email }}', '{{ $contact->time_operational }}')">
					<i class="fas fa-edit"></i> Edit
				</button>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telephone</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Operational</th>
						</tr>
					</thead>
					<tbody id="contact-table-body" class="bg-white divide-y divide-gray-200">
						<tr class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $contact->location }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $contact->telephone }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $contact->email }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $contact->time_operational }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit heading -->
<div id="modal-editContact" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
	<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
		<div class="p-4 border-b border-gray-200 flex justify-between">
			<h3 id="modal-title" class="text-lg font-semibold text-gray-800">Edit Item</h3>
			<button onclick="closeModal('modal-editContact')" class="text-gray-400 hover:text-gray-600">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<form action="{{ route('admin.contact.edit')}}" method="post" enctype="multipart/form-data">
			<div class="p-4">
				@csrf
				<input type="text" name="id" id="id" class="hidden">
				<div class="mb-4">
					<label for="location" class="block text-sm font-medium text-gray-700">Location</label>
					<textarea name="location" id="location" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
				</div>
				<div class="mb-4">
					<label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
					<input type="text" name="telephone" id="telephone" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4">
					<label for="email" class="block text-sm font-medium text-gray-700">Email</label>
					<input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
				</div>
				<div class="mb-4 flex flex-col sm:flex-row gap-4">
					<!-- Day Operational -->
					<div class="flex-1">
						<label class="block text-sm font-medium text-gray-700">Day Operational</label>
						<div class="flex items-center gap-2 mt-1">
							<select name="day-start" id="day-start" class="p-2 border border-gray-300 rounded-md w-full">
								<option value="Senin">Senin</option>
								<option value="Selasa">Selasa</option>
								<option value="Rabu">Rabu</option>
								<option value="Kamis">Kamis</option>
								<option value="Jumat">Jumat</option>
								<option value="Sabtu">Sabtu</option>
								<option value="Minggu">Minggu</option>
							</select>
							<span>-</span>
							<select name="day-end" id="day-end" class="p-2 border border-gray-300 rounded-md w-full">
								<option value="Senin">Senin</option>
								<option value="Selasa">Selasa</option>
								<option value="Rabu">Rabu</option>
								<option value="Kamis">Kamis</option>
								<option value="Jumat">Jumat</option>
								<option value="Sabtu">Sabtu</option>
								<option value="Minggu">Minggu</option>
							</select>
						</div>
					</div>

					<!-- Time Operational -->
					<div class="flex-1">
						<label class="block text-sm font-medium text-gray-700">Time Operational</label>
						<div class="flex items-center gap-2 mt-1">
							<input type="time" name="time-start" id="time-start" class="p-2 border border-gray-300 rounded-md w-full">
							<span>-</span>
							<input type="time" name="time-end" id="time-end" class="p-2 border border-gray-300 rounded-md w-full">
						</div>
					</div>
				</div>
			</div>
			<div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
				<button type="button" onclick="closeModal('modal-editContact')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')
<script>
	function editContact(button, id, location, telephone, email, time_operational_str) {
		const $btn = $(button);

		$('#id').val(id);
		$('#location').val(location);
		$('#telephone').val(telephone);
		$('#email').val(email);

		const timeParts = time_operational_str.split(':');
		if (timeParts.length >= 2) {
			const days = timeParts[0].trim().split(' - ');
			const times = timeParts[1].trim().replace('WIB', '').split(' - ');

			const dayStart = days[0]?.trim();
			const dayEnd = days[1]?.trim();
			const timeStart = times[0]?.trim().replace('.', ':');
			const timeEnd = times[1]?.trim().replace('.', ':');

			$('#day-start').val(dayStart);
			$('#day-end').val(dayEnd);
			$('#time-start').val(timeStart);
			$('#time-end').val(timeEnd);
		}

		openModal('modal-editContact');
	}
</script>
@endsection