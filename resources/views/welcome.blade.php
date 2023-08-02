<x-guest-layout>
    <div class="">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-300">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/">
                                <img class="object-fill h-12 w-12" src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                        <!-- Navigation Links -->
                        <div class="space-x-4 sm:-my-px ml-4 sm:flex">
                            <h1 class="font-bold text-xl">Pondok Pesantren Al-Basyariyah II</h1>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Menu
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Menu') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('auth.login') }}">
                                        {{ __('Login') }}
                                    </x-dropdown-link>
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
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-responsive-nav-link href="{{ route('auth.login') }}">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <main>
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            @foreach($images as $index => $image)
            <div class="text-center">
                <div class="p-5">
                    <div>
                        <h1 class="bg-blue-300 font-bold border-2 border-blue-500 rounded-full mx-auto p-3 h-16 w-16 text-2xl text-center">{{ $index+1 }}</h1>
                    </div>
                    <img src="{{ asset('storage/'.$image) }}" alt="">
                </div>
            </div>
            @endforeach
        </div>
        {{--
        <link rel="stylesheet" type="text/css" href="{{ asset('css/flickity.min.css') }}">
        <style type="text/css">
        .flickity-viewport {
            height: 500px !important;
        }
        </style>
        <div class="min-h-screen bg-black text-white flex items-center justify-center" x-data="carouselFilter()">
            <div class="container grid grid-cols-1">
                <div class="row-start-2 col-start-1" x-show="active == 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
                    <div class="grid grid-cols-1 grid-rows-1" x-data="carousel()" x-init="init()">
                        <div class="col-start-1 row-start-1 relative z-20 flex items-center justify-center pointer-events-none">
                            @foreach($images as $index => $image)
                            <h1 class="absolute text-5xl uppercase font-black tracking-widest" x-show="active == {{ $index }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-12" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-out duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-12">{{ $index+1 }}</h1>
                            @endforeach
                        </div>
                        <div class="carousel col-start-1 row-start-1" x-ref="carousel">
                            @foreach($images as $index => $image)
                            <div class="w-3/5 h-screen border border-white mx-2 p-2 rounded-lg">
                                <img class="rounded-lg object-contain" src="{{ asset('storage/'.$image) }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{{ asset('js/flickity.min.js') }}"></script>
            <script type="text/javascript">
            function carousel() {
                return {
                    active: 0,
                    init() {
                        var flkty = new Flickity(this.$refs.carousel, {
                            wrapAround: true
                        });
                        flkty.on('change', i => this.active = i);
                    }
                }
            }

            function carouselFilter() {
                return {
                    active: 0,
                    changeActive(i) {
                        this.active = i;

                        this.$nextTick(() => {
                            let flkty = Flickity.data(this.$el.querySelectorAll('.carousel')[i]);
                            flkty.resize();
                        });
                    }
                }
            }
            </script>
        </div> --}}
    </main>
</x-guest-layout>