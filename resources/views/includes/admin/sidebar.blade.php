<div class="sidebar bg-blue-800 text-white w-64 flex flex-col">
    <!-- Logo -->
    <div class="p-4 flex items-center justify-between border-b border-blue-700">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset($header->logo ? '/storage/' . $header->logo : 'images/img-logo.png') }}" alt="logo" class="rounded-full w-12">
            <span class="nav-text ml-3 font-bold text-xl">PT. Rayani Tata Bumi</span>
        </a>
    </div>

    <!-- Main Navigation -->
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-4 mb-8">
            <h3 class="nav-text uppercase text-xs font-semibold text-blue-300 mb-4">Main Menu</h3>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text ml-3">Dashboard</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.setting') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/setting') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text ml-3">Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="px-4 mb-8">
            <h3 class="nav-text uppercase text-xs font-semibold text-blue-300 mb-4">Management</h3>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.user') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/user') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-user"></i>
                        <span class="nav-text ml-3">User</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.header') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/header') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-header"></i>
                        <span class="nav-text ml-3">Header</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.product') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/product') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-box-open"></i>
                        <span class="nav-text ml-3">Product</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.portofolio') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/portofolio') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-briefcase"></i>
                        <span class="nav-text ml-3">Portofolio</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.about') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/about') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-info-circle"></i>
                        <span class="nav-text ml-3">About</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.feedback') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/feedback') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-comment-dots"></i>
                        <span class="nav-text ml-3">Feedback</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.contact') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/contact') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-envelope"></i>
                        <span class="nav-text ml-3">Contact</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.social') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('admin/social') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-share-nodes"></i>
                        <span class="nav-text ml-3">Social</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="px-4 mb-8">
            <h3 class="nav-text uppercase text-xs font-semibold text-blue-300 mb-4">Account</h3>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->is('profile') ? 'bg-blue-700' : '' }} text-white">
                        <i class="fas fa-address-card"></i>
                        <span class="nav-text ml-3">Profile</span>
                    </a>
                </li>
                <li class="mb-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 rounded-lg text-white hover:bg-blue-700">
                            <i class="fas fa-right-from-bracket"></i>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-blue-700">
        <div class="flex items-center">
            <div class="w-11 h-11 rounded-full overflow-hidden">
                <img src="{{ asset(Auth::user()->image ? '/storage/' . Auth::user()->image : 'images/profil_default.png') }}" alt="User profile" class="w-full h-full object-cover object-center avatarPreview" />
            </div>
            <div class="ml-3">
                <p class="font-medium">{{ Auth::user()->name }}</p>
                <p class="text-xs text-blue-300">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</div>