<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
            <div class="flex items-center justify-between py-4">
                <h1 class="w-auto text-3xl font-bold">Kelola Pendaftar</h1>
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
                            <x-th>Nama Siswa</x-th>
                            <x-th>Asal Sekolah</x-th>
                            <x-th>Tahun Ajaran</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @foreach($dataPendaftar as $index => $pendaftar)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $pendaftar->nama_siswa }}</x-td>
                            <x-td>{{ $pendaftar->asal_sekolah }}</x-td>
                            <x-td>{{ $pendaftar->tahun_ajaran }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $pendaftar->id_pendaftar }})">
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
                            {{ __('Tambah Pendaftar') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Silahkan isi form untuk menambahkan pendaftar baru.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama Pendaftar -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_siswa" value="{{ __('Nama Siswa') }}" />
                                <x-input id="nama_siswa" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_siswa" autocomplete="nama_siswa" />
                                <x-input-error for="state.nama_siswa" class="mt-2" />
                            </div>
                            <!-- Asal Sekolah -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="asal_sekolah" value="{{ __('Asal Sekolah') }}" />
                                <x-input id="asal_sekolah" type="text" class="mt-1 block w-full" wire:model.defer="state.asal_sekolah" autocomplete="asal_sekolah" />
                                <x-input-error for="state.asal_sekolah" class="mt-2" />
                            </div>
                            <!-- Tahun Ajaran -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="tahun_ajaran" value="{{ __('Tahun Ajaran') }}" />
                                <x-input id="tahun_ajaran" type="number" class="mt-1 block w-full" wire:model.defer="state.tahun_ajaran" autocomplete="tahun_ajaran" />
                                <x-input-error for="state.tahun_ajaran" class="mt-2" />
                            </div>
                            <!-- Nama Ortu -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_ortu" value="{{ __('Nama Orang Tua') }}" />
                                <x-input id="nama_ortu" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_ortu" autocomplete="nama_ortu" />
                                <x-input-error for="state.nama_ortu" class="mt-2" />
                            </div>
                            <!-- Kontak -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kontak" value="{{ __('Kontak') }}" />
                                <x-input id="kontak" type="text" class="mt-1 block w-full" wire:model.defer="state.kontak" autocomplete="kontak" />
                                <x-input-error for="state.kontak" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="pendaftar.saved">
                                {{ __('Berhasil menambahkan Pendaftar baru !') }}
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
                            {{ __('Detail Pendaftar') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Detail pendaftar dan dapat mengeditnya.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama Pendaftar -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_siswa" value="{{ __('Nama Siswa') }}" />
                                <x-input id="nama_siswa" type="text" class="mt-1 block w-full" wire:model.defer="detailPendaftar.nama_siswa" autocomplete="nama_siswa" />
                                <x-input-error for="detailPendaftar.nama_siswa" class="mt-2" />
                            </div>
                            <!-- Asal Sekolah -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="asal_sekolah" value="{{ __('Asal Sekolah') }}" />
                                <x-input id="asal_sekolah" type="text" class="mt-1 block w-full" wire:model.defer="detailPendaftar.asal_sekolah" autocomplete="asal_sekolah" />
                                <x-input-error for="detailPendaftar.asal_sekolah" class="mt-2" />
                            </div>
                            <!-- Tahun Ajaran -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="tahun_ajaran" value="{{ __('Tahun Ajaran') }}" />
                                <x-input id="tahun_ajaran" type="number" class="mt-1 block w-full" wire:model.defer="detailPendaftar.tahun_ajaran" autocomplete="tahun_ajaran" />
                                <x-input-error for="detailPendaftar.tahun_ajaran" class="mt-2" />
                            </div>
                            <!-- Nama Ortu -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_ortu" value="{{ __('Nama Orang Tua') }}" />
                                <x-input id="nama_ortu" type="text" class="mt-1 block w-full" wire:model.defer="detailPendaftar.nama_ortu" autocomplete="nama_ortu" />
                                <x-input-error for="detailPendaftar.nama_ortu" class="mt-2" />
                            </div>
                            <!-- Kontak -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="kontak" value="{{ __('Kontak') }}" />
                                <x-input id="kontak" type="text" class="mt-1 block w-full" wire:model.defer="detailPendaftar.kontak" autocomplete="kontak" />
                                <x-input-error for="detailPendaftar.kontak" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="pendaftar.updated">
                                {{ __('Berhasil update Pendaftar !') }}
                            </x-action-message>
                            <x-action-message class="mr-3" on="pendaftar.deleted">
                                {{ __('Data Pendaftar telah dihapus.') }}
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