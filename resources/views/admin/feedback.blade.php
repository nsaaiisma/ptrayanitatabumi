@extends('layouts.admin')
@section('title')
Feedback
@endsection

@section('content')
<div id="feedback-section">
	<div class="bg-white rounded-lg shadow overflow-hidden">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Feedback Management</h2>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
						</tr>
					</thead>
					<tbody id="feedback-table-body-unshown" class="bg-white divide-y divide-gray-200">
						@foreach ($feedbackUnshown as $feedbackUn)
						<tr id="feedback-row-{{ $feedbackUn->encrypted_id }}" class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackUn->name }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackUn->email }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackUn->message }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackUn->rating }}</td>
							<td class="px-6 py-4 text-xl text-gray-800 break-words">
								<i class="fa fa-toggle-off toggle-status cursor-pointer" data-id="{{ $feedbackUn->encrypted_id }}" data-status="inactive" title="Tampilkan"></i>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="bg-white rounded-lg shadow overflow-hidden mt-6">
		<div class="p-6">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-xl font-semibold text-gray-800">Feedback Shown</h2>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
						</tr>
					</thead>
					<tbody id="feedback-table-body-shown" class="bg-white divide-y divide-gray-200">
						@foreach ($feedbackShown as $feedbackShown)
						<tr id="feedback-row-{{ $feedbackShown->enrcypted_id }}" class="hover:bg-gray-50">
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackShown->name }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackShown->email }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackShown->message }}</td>
							<td class="px-6 py-4 text-sm text-gray-800 break-words">{{ $feedbackShown->rating }}</td>
							<td class="px-6 py-4 text-xl text-gray-800 break-words">
								<i class="fa fa-toggle-on toggle-status cursor-pointer" data-id="{{ $feedbackShown->encrypted_id }}" data-status="active" title="Sembunyikan"></i>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		// Tooltip otomatis
		$('.toggle-status').hover(function() {
			$(this).attr('data-tooltip', $(this).attr('title'));
		});

		// Toggle Status via AJAX
		$('.toggle-status').on('click', function() {
			let icon = $(this);
			let id = icon.data('id');
			let currentStatus = icon.data('status');
			let newStatus = currentStatus === 'active' ? 'inactive' : 'active';
			$.ajax({
				url: "{{ route('admin.feedback.toggle') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					id: id,
					status: newStatus
				},
				success: function(res) {
					if (res.success) {
						toastr_success('Status feedback diperbarui');

						// Ambil row yang sedang dipindahkan
						let row = $(`#feedback-row-${id}`);

						// Update icon dan data-status
						icon
							.toggleClass('fa-toggle-off fa-toggle-on')
							.data('status', newStatus)
							.attr('title', newStatus === 'active' ? 'Sembunyikan' : 'Tampilkan');

						// Pindahkan ke tabel target
						if (newStatus === 'active') {
							$('#feedback-table-body-shown').append(row);
						} else {
							$('#feedback-table-body-unshown').append(row);
						}
					} else {
						toastr_error('Terjadi kesalahan saat memperbarui status');
					}
				},
				error: function() {
					toastr_error('Terjadi kesalahan koneksi');
				}
			});
		});
	});
</script>

@endsection