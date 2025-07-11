<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset($header->logo ? '/storage/' . $header->logo : 'images/img-logo.png') }}">
    @include('includes.admin.style')
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('includes.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-auto bg-gray-100">

            <!-- Top Bar -->
            @include('includes.admin.topbar')

            <!-- Main Content + Footer dalam kolom -->
            <div class="flex-1 flex flex-col">
                <main class="flex-1 p-6">
                    @yield('content')
                </main>

                <!-- Footer -->
                @include('includes.admin.footer')
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Confirm Delete</h3>
                <p class="text-gray-600 text-center mb-6">Are you sure you want to delete this item? This action cannot
                    be undone.</p>
                <div class="flex justify-center space-x-4">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.script')
    @yield('script')
</body>