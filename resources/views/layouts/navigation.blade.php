<nav x-data="{ open: false }"
    class="bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-md sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-3">

                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                        <div class="w-9 h-9 md:w-11 md:h-11 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl font-bold">
                                🛠
                            </span>

                        </div>

                        <div>

                            <h1 class="font-bold text-gray-800 text-base md:text-lg">
                                Pelaporan
                            </h1>

                            <p class="hidden md:block text-xs text-gray-500">
                                Fasilitas Sekolah
                            </p>

                        </div>

                    </a>

                </div>
                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-2 ml-10">

                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                    {{ request()->routeIs('dashboard')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        🏠 Dashboard
                    </a>

                    @if(auth()->user()->role == 'admin')

                    <a href="{{ route('lokasi.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                        {{ request()->routeIs('lokasi.*')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        📍 Lokasi
                    </a>

                    <a href="{{ route('kategori.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                        {{ request()->routeIs('kategori.*')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        📂 Kategori
                    </a>

                    <a href="{{ route('user.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                        {{ request()->routeIs('user.*')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        👥 User
                    </a>

                    <a href="{{ route('petugas.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                        {{ request()->routeIs('petugas.*')
                            ? 'bg-blue-600 text-white shadow-lg'
                            : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        🛠 Petugas
                    </a>

                    <a href="{{ route('activity.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                    {{ request()->routeIs('activity.*')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        📜 Activity Log
                    </a>

                    @endif

                    <a href="{{ route('laporan.index') }}"
                        class="px-4 py-2 rounded-xl transition-all duration-300
                    {{ request()->routeIs('laporan.*')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

                        📋 {{ auth()->user()->role == 'admin' ? 'Laporan' : 'Laporan Saya' }}
                    </a>

                </div>



                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center">

                    <x-dropdown align="right" width="60">

                        <x-slot name="trigger">

                            <button
                                class="flex items-center gap-3 bg-white hover:bg-gray-50 border border-gray-200 rounded-2xl px-4 py-2 shadow-sm transition">

                                <div
                                    class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg">

                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                                </div>

                                <div class="text-left">

                                    <div class="font-semibold text-gray-800">
                                        {{ Auth::user()->name }}
                                    </div>

                                    <div class="text-xs text-gray-500">

                                        @if(Auth::user()->role=='admin')
                                        👑 Administrator
                                        @elseif(Auth::user()->role=='petugas')
                                        🛠 Petugas
                                        @else
                                        🎓 Siswa
                                        @endif

                                    </div>

                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-gray-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </button>

                        </x-slot>

                        <x-slot name="content">

                            <div class="px-4 py-3 border-b">

                                <div class="font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ Auth::user()->email }}
                                </div>

                            </div>

                            <x-dropdown-link :href="route('profile.edit')">

                                👤 Profile

                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">

                                @csrf

                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();">

                                    🚪 Logout

                                </x-dropdown-link>

                            </form>

                        </x-slot>

                    </x-dropdown>

                </div>
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition duration-300">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            x-show="open"
            x-transition
            class="sm:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')">

                    🏠 Dashboard

                </x-responsive-nav-link>

                @if(auth()->user()->role == 'admin')

                <x-responsive-nav-link
                    :href="route('lokasi.index')"
                    :active="request()->routeIs('lokasi.*')">

                    Lokasi

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('kategori.index')"
                    :active="request()->routeIs('kategori.*')">

                    Kategori Kerusakan

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('user.index')"
                    :active="request()->routeIs('user.*')">

                    User

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('petugas.index')"
                    :active="request()->routeIs('petugas.*')">

                    Petugas

                </x-responsive-nav-link>

                @endif

                <x-responsive-nav-link
                    :href="route('laporan.index')"
                    :active="request()->routeIs('laporan.*')">

                    {{ auth()->user()->role == 'admin'
    ? 'Laporan'
    : 'Laporan Saya' }}

                </x-responsive-nav-link>
            </div>


            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
</nav>