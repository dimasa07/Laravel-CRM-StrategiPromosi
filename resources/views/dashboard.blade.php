<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel CRM</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <div class="min-h-screen bg-gray-100">
        @livewire('nav-menu')
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </header>
        @endif
        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                            <x-application-logo class="block h-12 w-auto" />
                            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                                Selamat datang di aplikasi Sistem Informasi Strategi Promosi Pondok Pesantren Al-Basyariyah II !
                            </h1>
                            @if(Auth::user()->hak_akses == 'Admin')
                            <p class="mt-6 text-gray-500 leading-relaxed">
                                Silahkan gunakan aplikasi untuk mengelola user yang akan diberikan akses untuk menggunakan aplikasi ini.
                            </p>
                            @endif
                            @if(Auth::user()->hak_akses == 'PPSB')
                            <p class="mt-6 text-gray-500 leading-relaxed">
                                Silahkan gunakan aplikasi untuk mengelola data promosi dan menentukan strategi promosi yang tepat untuk mendapatkan jumlah pendaftar yang maksimal.
                            </p>
                            <p class="mt-2 text-gray-500 leading-relaxed">
                            Lakukan pemasagan promosi yang akan ditampilkan di halaman depan aplikasi, dengan menambahkan gambar-gambar yang telah disediakan dibawah ini : 
                            </p>
                            @endif
                        </div>
                        @if(Auth::user()->hak_akses == 'PPSB')
                        @livewire('promosi')
                        @endif
                        {{-- <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                        <a href="https://laravel.com/docs">Documentation</a>
                                    </h2>
                                </div>
                                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                    Laravel has wonderful documentation covering every aspect of the framework. Whether you're new to the framework or have previous experience, we recommend reading all of the documentation from beginning to end.
                                </p>
                                <p class="mt-4 text-sm">
                                    <a href="https://laravel.com/docs" class="inline-flex items-center font-semibold text-indigo-700">
                                        Explore the documentation
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </main>
    </div>
    @stack('modals')
    @livewireScripts
</body>

</html>