<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
            <div class="flex items-center justify-between py-4">
                <h1 class="w-auto text-3xl font-bold">Kelola Alternatif</h1>
                <x-button-info @click="activeTab = 'tambah'" x-show="activeTab == 'data'">
                    Tambah
                </x-button-info>
                <x-button-normal style="display: none;" @click="activeTab = 'data'" x-show="activeTab != 'data'">
                    Data
                </x-button-normal>
            </div>
            <hr>
            <div class="mt-8" x-show="activeTab == 'data'">
                <div>
                    <x-table>
                        <tr>
                            <x-th>No</x-th>
                            <x-th>Kode</x-th>
                            <x-th>Bauran Promosi</x-th>
                            <x-th>Jenis</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @foreach($dataAlternatif as $index => $alternatif)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $alternatif->kode_alternatif }}</x-td>
                            <x-td>{{ $alternatif->bauran_promosi }}</x-td>
                            <x-td>{{ $alternatif->jenis }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $alternatif->id_alternatif }})">
                                        Detail
                                    </x-button-normal>
                                </div>
                            </x-td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
            <div class="mt-8" x-show="activeTab == 'tambah'" style="display: none;">
                <div>
                    <x-form-section submit="tambah">
                        <x-slot name="title">
                            {{ __('Tambah Alternatif') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Silahkan isi form untuk menambahkan alternatif baru.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Kode Alternatif -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kode_alternatif" value="{{ __('Kode Alternatif') }}" />
                                <x-input id="kode_alternatif" type="text" class="mt-1 block w-full" wire:model.defer="state.kode_alternatif" autocomplete="kode_alternatif" />
                                <x-input-error for="state.kode_alternatif" class="mt-2" />
                            </div>
                            <!-- Bauran Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="bauran_promosi" value="{{ __('Bauran Promosi') }}" />
                                <x-input id="bauran_promosi" type="text" class="mt-1 block w-full" wire:model.defer="state.bauran_promosi" autocomplete="bauran_promosi" />
                                <x-input-error for="state.bauran_promosi" class="mt-2" />
                            </div>
                            <!-- Jenis -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jenis" value="{{ __('Jenis') }}" />
                                <x-input id="jenis" type="text" class="mt-1 block w-full" wire:model.defer="state.jenis" autocomplete="jenis" />
                                <x-input-error for="state.jenis" class="mt-2" />
                            </div>
                            <!-- Waktu Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="waktu_promosi" value="{{ __('Waktu Promosi') }}" />
                                <x-input id="waktu_promosi" type="text" class="mt-1 block w-full" wire:model.defer="state.waktu_promosi" autocomplete="waktu_promosi" />
                                <x-input-error for="state.waktu_promosi" class="mt-2" />
                            </div>
                            <!-- Skala Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="skala_promosi" value="{{ __('Skala Promosi') }}" />
                                <x-input id="skala_promosi" type="text" class="mt-1 block w-full" wire:model.defer="state.skala_promosi" autocomplete="skala_promosi" />
                                <x-input-error for="state.skala_promosi" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="alternatif.saved">
                                {{ __('Berhasil menambahkan Alternatif baru !') }}
                            </x-action-message>
                            <x-button-success type="submit" wire:loading.attr="disabled" wire:target="photo">
                                {{ __('Save') }}
                            </x-button-success>
                        </x-slot>
                    </x-form-section>
                </div>
            </div>
            <div class="mt-8" x-show="activeTab == 'detail'" style="display: none;">
                <div>
                    <x-form-section submit="update" >
                        <x-slot name="title">
                            {{ __('Detail Alternatif') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Detail alternatif dan dapat mengeditnya.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Kode Alternatif -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kode_alternatif" value="{{ __('Kode Alternatif') }}" />
                                <x-input id="kode_alternatif" type="text" class="mt-1 block w-full" wire:model.defer="detailAltenatif.kode_alternatif" autocomplete="kode_alternatif" />
                                <x-input-error for="detailAltenatif.kode_alternatif" class="mt-2" />
                            </div>
                            <!-- Bauran Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="bauran_promosi" value="{{ __('Bauran Promosi') }}" />
                                <x-input id="bauran_promosi" type="text" class="mt-1 block w-full" wire:model.defer="detailAltenatif.bauran_promosi" autocomplete="bauran_promosi" />
                                <x-input-error for="detailAltenatif.bauran_promosi" class="mt-2" />
                            </div>
                            <!-- Jenis -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jenis" value="{{ __('Jenis') }}" />
                                <x-input id="jenis" type="text" class="mt-1 block w-full" wire:model.defer="detailAltenatif.jenis" autocomplete="jenis" />
                                <x-input-error for="detailAltenatif.jenis" class="mt-2" />
                            </div>
                            <!-- Waktu Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="waktu_promosi" value="{{ __('Waktu Promosi') }}" />
                                <x-input id="waktu_promosi" type="text" class="mt-1 block w-full" wire:model.defer="detailAltenatif.waktu_promosi" autocomplete="waktu_promosi" />
                                <x-input-error for="detailAltenatif.waktu_promosi" class="mt-2" />
                            </div>
                            <!-- Skala Promosi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="skala_promosi" value="{{ __('Skala Promosi') }}" />
                                <x-input id="skala_promosi" type="text" class="mt-1 block w-full" wire:model.defer="detailAltenatif.skala_promosi" autocomplete="skala_promosi" />
                                <x-input-error for="detailAltenatif.skala_promosi" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="alternatif.updated">
                                {{ __('Berhasil update Alternatif !') }}
                            </x-action-message>
                            <x-action-message class="mr-3" on="alternatif.deleted">
                                {{ __('Data Alternatif telah dihapus.') }}
                            </x-action-message>
                            <div class="inline-flex" x-show="!deleted">
                                <x-button-info class="mx-2" type="submit" wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Ubah') }}
                                </x-button-info>
                                <x-button-danger type="button" wire:click="delete" @click="deleted = true" wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Hapus') }}
                                </x-button-danger>
                            </div>
                        </x-slot>
                    </x-form-section>
                </div>
            </div>
        </div>
    </div>
</div>