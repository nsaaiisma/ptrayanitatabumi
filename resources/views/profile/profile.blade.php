@extends('layouts.admin')
@section('title')
Profile
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-4">
        <!-- Sidebar Navigation -->
        <div class="bg-gray-100 p-6 border-b md:border-b-0 md:border-r border-gray-200">
            <div class="avatar-upload mb-6">
                <div class="avatar-edit">
                    <button id="changeAvatarBtn" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full p-2">
                        <i class="fas fa-camera"></i>
                    </button>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden" />
                </div>
                <div class="avatar-preview bg-gray-200 w-40 h-40 rounded-full overflow-hidden">
                    <img src="{{ asset(Auth::user()->image ? '/storage/' . Auth::user()->image : 'images/profil_default.png') }}" alt="profile image" class="w-full h-full object-cover object-center avatarPreview" />
                </div>
            </div>

            <nav>
                <ul class="space-y-2">
                    <li>
                        <button onclick="changeTab('profile')" class="w-full text-left px-4 py-2 rounded-md font-medium bg-blue-500 text-white">
                            <i class="fas fa-user mr-2"></i> Profile Information
                        </button>
                    </li>
                    <li>
                        <button onclick="changeTab('password')" class="w-full text-left px-4 py-2 rounded-md font-medium text-gray-700 hover:bg-gray-200">
                            <i class="fas fa-lock mr-2"></i> Update Password
                        </button>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="col-span-3 p-6">
            <div id="tab-content">
                <!-- Profile Information Tab -->
                <div id="profile" class="active">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Profile Information</h2>
                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ Auth::user()->username }}" required>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="resetProfileForm()" class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Update Password Tab -->
                <div id="password">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Update Password</h2>
                    <form id="passwordForm" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="currentPassword" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" id="currentPassword" name="currentPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">New
                                    Password</label>
                                <input type="password" id="newPassword" name="newPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="resetPasswordForm()" class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#avatarInput').on('change', function() {
            let formData = new FormData();
            let file = this.files[0];

            if (!file) return;

            formData.append('avatar', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('profile.update.avatar') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        $('.avatarPreview').attr('src', response.image_url);
                        toastr_success(response.message);
                    } else {
                        toastr_error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMsg = Object.values(xhr.responseJSON.errors).flat().join(
                            ', ');
                        toastr.error(errorMsg);
                    } else {
                        toastr.error(xhr.responseJSON.message ||
                            'Gagal memperbarui foto profil.');
                    }
                }
            });
        });

        $('#changeAvatarBtn').on('click', function(e) {
            e.preventDefault();
            $('#avatarInput').click();
        });

        window.changeTab = function(tabId) {
            $('nav button').each(function() {
                let btnText = $(this).text().trim();
                if ((tabId === 'profile' && btnText.includes('Profile')) || (tabId === 'password' &&
                        btnText.includes('Password'))) {
                    $(this).removeClass('text-gray-700 hover:bg-gray-200')
                        .addClass('bg-blue-500 text-white');
                } else {
                    $(this).removeClass('bg-blue-500 text-white')
                        .addClass('text-gray-700 hover:bg-gray-200');
                }
            });

            // Tampilkan konten tab aktif
            $('#tab-content > div').removeClass('active');
            $('#' + tabId).addClass('active');
        };


        window.resetProfileForm = function() {
            $('#profileForm')[0].reset();
        };

        // Submit form password
        $('#confirmPassword').on('change', function(e) {
            // e.preventDefault();
            const newPassword = $('#newPassword').val();
            const confirmPassword = $('#confirmPassword').val();

            if (newPassword !== confirmPassword) {
                toastr_error('password not match')
                $(this).removeClass('border-gray-300')
                    .addClass('border-red-300');
            } else if (newPassword == confirmPassword) {
                $(this).removeClass('border-gray-300 border-red-300')
                    .addClass('border-green-300');
            } else {
                $(this).removeClass('border-green-300 border-red-300')
                    .addClass('border-gray-300');
            }
        });

        window.resetPasswordForm = function() {
            $('#passwordForm')[0].reset();
        };
    });
</script>
@endsection