<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Rincian Biaya') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @livewire('ppsb.kelola-rincian-biaya')
    </div>
</x-app-layout>