<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="block h-9 w-auto">
                            <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5" />
                            <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5" />
                        </svg>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    @if(Auth::user()->hak_akses == 'Admin')
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('admin.index')  ">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.kelola-user') }}" :active="request()->routeIs('admin.kelola-user') ">
                        {{ __('Kelola User') }}
                    </x-nav-link>
                    @endif
                    @if(Auth::user()->hak_akses == 'PPSB')
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('ppsb.index')  ">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('ppsb.kelola-alternatif') }}" :active="request()->routeIs('ppsb.kelola-alternatif') ">
                        {{ __('Alternatif') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('ppsb.kelola-kriteria') }}" :active="request()->routeIs('ppsb.kelola-kriteria') ">
                        {{ __('Kriteria') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('ppsb.kelola-rincian-biaya') }}" :active="request()->routeIs('ppsb.kelola-rincian-biaya') ">
                        {{ __('Rincian Biaya') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->nama_pengguna }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-dropdown-link href="{{ route('user.profil') }}">
                                {{ __('Akun') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->hak_akses == 'Admin')
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('admin.index')  ">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('admin.kelola-user') }}" :active="request()->routeIs('admin.kelola-user') ">
                {{ __('Kelola User') }}
            </x-responsive-nav-link>
            @endif
            @if(Auth::user()->hak_akses == 'PPSB')
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('ppsb.index')  ">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('ppsb.kelola-alternatif') }}" :active="request()->routeIs('ppsb.kelola-alternatif') ">
                {{ __('Alternatif') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('ppsb.kelola-kriteria') }}" :active="request()->routeIs('ppsb.kelola-kriteria') ">
                {{ __('Kriteria') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('ppsb.kelola-rincian-biaya') }}" :active="request()->routeIs('ppsb.kelola-rincian-biaya') ">
                {{ __('Rincian Biaya') }}
            </x-responsive-nav-link>
            @endif
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->nama_pengguna }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->username }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('user.profil') }}" :active="request()->routeIs('user.profil')">
                    {{ __('Akun') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>