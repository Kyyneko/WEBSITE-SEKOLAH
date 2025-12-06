<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left Side: Logo -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center transition-transform duration-200 hover:scale-105">
                        <img class="h-16 w-16 object-contain" src="{{ asset('image/Logo.png') }}" alt="{{ config('app.name', 'School Website') }} Logo">
                        <div class="ml-3 hidden lg:block">
                            <div class="text-lg font-bold text-gray-800 leading-tight">SMP NEGERI</div>
                            <div class="text-sm text-gray-600">KALUMPANG</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Center: Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Perangkat -->
                <a href="{{ route('perangkat') }}" 
                   class="nav-link {{ request()->routeIs('perangkat') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Perangkat</span>
                </a>

                <!-- Admin Only Menus -->
                @if (auth()->user()->role === 'admin')
                    <!-- Users -->
                    <a href="{{ route('users.index') }}" 
                       class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>

                    <!-- Mapel -->
                    <a href="{{ route('subjects.index') }}" 
                       class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <span>Mapel</span>
                    </a>

                    <!-- Iklan -->
                    <a href="{{ route('ads.index') }}" 
                       class="nav-link {{ request()->routeIs('ads.*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i>
                        <span>Iklan</span>
                    </a>

                    <!-- Organisasi -->
                    <a href="{{ route('organisasi.index') }}" 
                       class="nav-link {{ request()->routeIs('organisasi.*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap"></i>
                        <span>Organisasi</span>
                    </a>
                @endif

                <!-- Artikel -->
                <a href="{{ route('articles.index') }}" 
                   class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Artikel</span>
                </a>
            </div>

            <!-- Right Side: User Dropdown (Desktop) -->
<div class="hidden sm:flex sm:items-center">
    <x-dropdown align="right" width="64">
        <x-slot name="trigger">
            <button class="flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold mr-2">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="text-left mr-2">
                    <div class="font-semibold text-sm truncate max-w-[120px]">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-xs text-gray-500 flex items-center">
                        @if(Auth::user()->role === 'admin')
                            <i class="fas fa-shield-alt mr-1"></i>Admin
                        @else
                            <i class="fas fa-chalkboard-teacher mr-1"></i>Guru
                        @endif
                    </div>
                </div>
                <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <!-- User Info Header -->
            <div class="px-4 py-3 bg-gradient-to-r from-indigo-50 to-blue-50 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <div class="font-semibold text-sm text-gray-900 truncate">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-xs text-gray-600 truncate">
                            {{ Auth::user()->email }}
                        </div>
                        <div class="mt-1">
                            @if(Auth::user()->role === 'admin')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                    <i class="fas fa-shield-alt mr-1"></i>Administrator
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>Guru
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Link -->
            <x-dropdown-link :href="route('profile.edit')">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg mr-3">
                        <i class="fas fa-user-circle text-gray-600"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Profile</div>
                        <div class="text-xs text-gray-500">Kelola akun Anda</div>
                    </div>
                </div>
            </x-dropdown-link>

            <!-- Divider -->
            <div class="border-t border-gray-100"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" 
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="hover:bg-red-50">
                    <div class="flex items-center">
                        <div class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg mr-3">
                            <i class="fas fa-sign-out-alt text-red-600"></i>
                        </div>
                        <div>
                            <div class="font-medium text-red-600">Log Out</div>
                            <div class="text-xs text-red-500">Keluar dari sistem</div>
                        </div>
                    </div>
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>

            <!-- Hamburger (Mobile) -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden border-t border-gray-200 bg-white">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>

            <!-- Perangkat -->
            <a href="{{ route('perangkat') }}" 
               class="mobile-nav-link {{ request()->routeIs('perangkat') ? 'active' : '' }}">
                <i class="fas fa-file-alt mr-3"></i>
                @if (auth()->user()->role === 'admin')
                    Perangkat
                @else
                    Perangkat Pembelajaran
                @endif
            </a>

            @if (auth()->user()->role === 'admin')
                <!-- Users -->
                <a href="{{ route('users.index') }}" 
                   class="mobile-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Users Management
                </a>

                <!-- Mapel -->
                <a href="{{ route('subjects.index') }}" 
                   class="mobile-nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                    <i class="fas fa-book mr-3"></i>
                    Mapel Management
                </a>

                <!-- Iklan -->
                <a href="{{ route('ads.index') }}" 
                   class="mobile-nav-link {{ request()->routeIs('ads.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn mr-3"></i>
                    Ads Management
                </a>

                <!-- Organisasi -->
                <a href="{{ route('organisasi.index') }}" 
                   class="mobile-nav-link {{ request()->routeIs('organisasi.*') ? 'active' : '' }}">
                    <i class="fas fa-sitemap mr-3"></i>
                    Organisasi Management
                </a>
            @endif

            <!-- Artikel -->
            <a href="{{ route('articles.index') }}" 
               class="mobile-nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper mr-3"></i>
                Article Management
            </a>
        </div>

        <!-- Mobile User Section -->
        <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
            <div class="px-4 mb-3 flex items-center">
                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="ml-3">
                    <div class="font-semibold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    <div class="text-xs text-gray-400 mt-1">
                        @if(Auth::user()->role === 'admin')
                            <i class="fas fa-shield-alt mr-1"></i>Administrator
                        @else
                            <i class="fas fa-chalkboard-teacher mr-1"></i>Guru
                        @endif
                    </div>
                </div>
            </div>

            <div class="px-2 space-y-1">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">
                    <i class="fas fa-user-circle mr-3"></i>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-nav-link text-red-600 w-full text-left">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>

        /* Dropdown Enhancements */
    [x-cloak] {
        display: none !important;
    }

    /* User Dropdown Trigger */
    .user-dropdown-trigger {
        min-width: 200px;
    }

    /* Dropdown Content */
    .dropdown-content {
        min-width: 280px;
        max-width: 320px;
    }

    /* Dropdown Link Hover */
    a[class*="dropdown-link"] {
        transition: all 0.15s ease-in-out;
    }

    a[class*="dropdown-link"]:hover {
        transform: translateX(4px);
    }

    /* Truncate Text */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Role Badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 0.375rem;
    }

    /* Dropdown Animation */
    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-animate {
        animation: dropdownSlide 0.2s ease-out;
    }
    /* Desktop Navigation Links */
    .nav-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .nav-link:hover {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .nav-link.active {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
    }

    .nav-link i {
        font-size: 1rem;
    }

    /* Mobile Navigation Links */
    .mobile-nav-link {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .mobile-nav-link:hover {
        background-color: #f3f4f6;
        color: #1f2937;
        padding-left: 1.25rem;
    }

    .mobile-nav-link.active {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        border-left: 4px solid #4f46e5;
    }

    /* Sticky Navigation */
    nav {
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Smooth Transitions */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
