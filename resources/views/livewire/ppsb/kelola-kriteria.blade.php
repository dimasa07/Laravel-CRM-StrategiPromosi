<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
            <div class="flex items-center justify-between py-4">
                <h1 class="w-auto text-3xl font-bold">Kelola Kriteria</h1>
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
                            <x-th>Nama Kriteria</x-th>
                            <x-th>Bobot</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @foreach($dataKriteria as $index => $kriteria)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $kriteria->kode_kriteria }}</x-td>
                            <x-td>{{ $kriteria->nama_kriteria }}</x-td>
                            <x-td>{{ $kriteria->bobot }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $kriteria->id_kriteria }})">
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
                            {{ __('Tambah Kriteria') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Silahkan isi form untuk menambahkan kriteria baru.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Kode Kriteria -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kode_kriteria" value="{{ __('Kode Kriteria') }}" />
                                <x-input id="kode_kriteria" type="text" class="mt-1 block w-full" wire:model.defer="state.kode_kriteria" autocomplete="kode_kriteria" />
                                <x-input-error for="state.kode_kriteria" class="mt-2" />
                            </div>
                            <!-- Nama Kriteria -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_kriteria" value="{{ __('Nama Kriteria') }}" />
                                <x-input id="nama_kriteria" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_kriteria" autocomplete="nama_kriteria" />
                                <x-input-error for="state.nama_kriteria" class="mt-2" />
                            </div>
                            <!-- Keterangan -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="keterangan" value="{{ __('Keterangan') }}" />
                                <x-input id="keterangan" type="text" class="mt-1 block w-full" wire:model.defer="state.keterangan" autocomplete="keterangan" />
                                <x-input-error for="state.keterangan" class="mt-2" />
                            </div>
                            <!-- Bobot -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="bobot" value="{{ __('Bobot') }}" />
                                <x-input id="bobot" type="text" class="mt-1 block w-full" wire:model.defer="state.bobot" autocomplete="bobot" />
                                <x-input-error for="state.bobot" class="mt-2" />
                            </div>
                            <!-- Jenis -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jenis" value="{{ __('Jenis') }}" />
                                <x-select id="jenis" class="mt-1 block w-full" wire:model.defer="state.jenis" autocomplete="jenis">
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </x-select>
                                <x-input-error for="state.jenis" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="kriteria.saved">
                                {{ __('Berhasil menambahkan Kriteria baru !') }}
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
                            {{ __('Detail Kriteria') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Detail kriteria dan dapat mengeditnya.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Kode Kriteria -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kode_kriteria" value="{{ __('Kode Kriteria') }}" />
                                <x-input id="kode_kriteria" type="text" class="mt-1 block w-full" wire:model.defer="detailKriteria.kode_kriteria" autocomplete="kode_kriteria" />
                                <x-input-error for="detailKriteria.kode_kriteria" class="mt-2" />
                            </div>
                            <!-- Nama Kriteria -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_kriteria" value="{{ __('Nama Kriteria') }}" />
                                <x-input id="nama_kriteria" type="text" class="mt-1 block w-full" wire:model.defer="detailKriteria.nama_kriteria" autocomplete="nama_kriteria" />
                                <x-input-error for="detailKriteria.nama_kriteria" class="mt-2" />
                            </div>
                            <!-- Keterangan -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="keterangan" value="{{ __('Keterangan') }}" />
                                <x-input id="keterangan" type="text" class="mt-1 block w-full" wire:model.defer="detailKriteria.keterangan" autocomplete="keterangan" />
                                <x-input-error for="detailKriteria.keterangan" class="mt-2" />
                            </div>
                            <!--  Bobot -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="bobot" value="{{ __('Bobot') }}" />
                                <x-input id="bobot" type="text" class="mt-1 block w-full" wire:model.defer="detailKriteria.bobot" autocomplete="bobot" />
                                <x-input-error for="detailKriteria.bobot" class="mt-2" />
                            </div>
                            <!-- Jenis -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jenis" value="{{ __('Jenis') }}" />
                                <x-select id="jenis" class="mt-1 block w-full" wire:model.defer="detailKriteria.jenis" autocomplete="jenis">
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </x-select>
                                <x-input-error for="detailKriteria.jenis" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="kriteria.updated">
                                {{ __('Berhasil update Kriteria !') }}
                            </x-action-message>
                            <x-action-message class="mr-3" on="kriteria.deleted">
                                {{ __('Data Kriteria telah dihapus.') }}
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