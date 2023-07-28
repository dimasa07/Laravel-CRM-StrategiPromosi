<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
            <div class="flex items-center justify-between py-4">
                <h1 class="w-auto text-3xl font-bold">Kelola Rincian Biaya</h1>
                <div style="display: none;" class="inline-flex" x-show="activeTab == 'dataRincian'">
                    <x-button-info class="mx-2" @click="activeTab = 'tambah'">
                        Tambah
                    </x-button-info>
                    <x-button-normal @click="activeTab = 'data'">
                        Tutup
                    </x-button-normal>
                </div>
                <x-button-normal style="display: none;" @click="activeTab = 'dataRincian'" x-show="activeTab == 'tambah' || activeTab == 'detail'" x-text="activeTab == 'tambah' ? 'Batal' : 'Tutup'">
                </x-button-normal>
            </div>
            @if($index != -1)
            <h2 style="display: none;" x-show="activeTab == 'dataRincian'">Rincian Biaya : {{ $dataAlternatif[$index]->jenis }} ({{ $dataAlternatif[$index]->kode_alternatif }})</h2>
            @endif
            <hr>
            <div class="mt-8" x-show="activeTab == 'data'">
                <div>
                    <x-table>
                        <tr>
                            <x-th>No</x-th>
                            <x-th>Kode Alternatif</x-th>
                            <x-th>Jenis Alternatif</x-th>
                            <x-th>Total Biaya</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @foreach($dataAlternatif as $index => $alternatif)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $alternatif->kode_alternatif }}</x-td>
                            <x-td>{{ $alternatif->jenis }}</x-td>
                            <x-td>{{ $alternatif->totalHarga() }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-success @click="activeTab = 'dataRincian'; deleted = false" wire:click="dataRincian({{ $index }},{{ $alternatif->id_alternatif }})">
                                        Lihat
                                    </x-button-success>
                                </div>
                            </x-td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
            <div class="mt-8" x-show="activeTab == 'dataRincian'" style="display: none;">
                <div>
                    <x-table>
                        <tr>
                            <x-th>No</x-th>
                            <x-th>Nama Rincian</x-th>
                            <x-th>Total</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @if($dataRincian)
                        @foreach($dataRincian as $index => $rincian)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $rincian->nama_rincian }}</x-td>
                            <x-td>{{ $rincian->total }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $rincian->id_rincian_biaya }})">
                                        Detail
                                    </x-button-normal>
                                </div>
                            </x-td>
                        </tr>
                        @endforeach
                        @endif
                    </x-table>
                </div>
            </div>
            <div class="mt-8" x-show="activeTab == 'tambah'" style="display: none;">
                <div>
                    <x-form-section submit="tambah">
                        <x-slot name="title">
                            {{ __('Tambah Rincian Biaya') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Silahkan isi form untuk menambahkan rincian biaya baru.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama Rincian -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_rincian" value="{{ __('Nama Rincian Biaya') }}" />
                                <x-input id="nama_rincian" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_rincian" autocomplete="nama_rincian" />
                                <x-input-error for="state.nama_rincian" class="mt-2" />
                            </div>
                            <!-- Harga -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="harga" value="{{ __('Harga Satuan') }}" />
                                <x-input id="harga" type="number" class="mt-1 block w-full" wire:model.defer="state.harga" autocomplete="harga" />
                                <x-input-error for="state.harga" class="mt-2" />
                            </div>
                            <!-- Jumlah -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jumlah" value="{{ __('Jumlah') }}" />
                                <x-input id="jumlah" type="number" class="mt-1 block w-full" wire:model.defer="state.jumlah" autocomplete="jumlah" />
                                <x-input-error for="state.jumlah" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="rincian.saved">
                                {{ __('Berhasil menambahkan Rincian Biaya baru !') }}
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
                    <x-form-section submit="update">
                        <x-slot name="title">
                            {{ __('Detail Rincian Biaya') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Detail rincian biaya dan dapat mengeditnya.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama Rincian -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_rincian" value="{{ __('Nama Rincian') }}" />
                                <x-input id="nama_rincian" type="text" class="mt-1 block w-full" wire:model.defer="detailRincian.nama_rincian" autocomplete="nama_rincian" />
                                <x-input-error for="detailRincian.nama_rincian" class="mt-2" />
                            </div>
                            <!-- Harga -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="harga" value="{{ __('Harga Satuan') }}" />
                                <x-input id="harga" type="number" class="mt-1 block w-full" wire:model.defer="detailRincian.harga" autocomplete="harga" />
                                <x-input-error for="detailRincian.harga" class="mt-2" />
                            </div>
                            <!-- Jumlah -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="jumlah" value="{{ __('Jumlah') }}" />
                                <x-input id="jumlah" type="number" class="mt-1 block w-full" wire:model.defer="detailRincian.jumlah" autocomplete="jumlah" />
                                <x-input-error for="detailRincian.jumlah" class="mt-2" />
                            </div>
                            <!-- Total -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="total" value="{{ __('Total') }}" />
                                <x-input disabled id="total" type="text" class="mt-1 block w-full" wire:model.defer="detailRincian.total" autocomplete="total" />
                                <x-input-error for="detailRincian.total" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="rincian.updated">
                                {{ __('Berhasil update Rincian Biaya !') }}
                            </x-action-message>
                            <x-action-message class="mr-3" on="rincian.deleted">
                                {{ __('Data Rincian Biaya telah dihapus.') }}
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