<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
                <div class="flex items-center justify-between py-4">
                    <h1 class="w-auto text-3xl font-bold">Kelola Penilaian</h1>
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
                                <x-th>Jenis Alternatif</x-th>
                                <x-th>Kriteria</x-th>
                                <x-th>Bobot</x-th>
                                <x-th>Aksi</x-th>
                            </tr>
                            @foreach($dataPenilaian as $index => $penilaian)
                            <tr>
                                <x-td class="text-center">{{ $index+1 }}</x-td>
                                <x-td>{{ $penilaian->alternatif->kode_alternatif }} ({{ $penilaian->alternatif->jenis }})</x-td>
                                <x-td>{{ $penilaian->kriteria->kode_kriteria }} ({{ $penilaian->kriteria->nama_kriteria }})</x-td>
                                <x-td class="text-center">{{ $penilaian->bobot }}</x-td>
                                <x-td class="text-center">
                                    <div class="inline-flex">
                                        <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $penilaian->id_penilaian }})">
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
                                {{ __('Tambah Penilaian') }}
                            </x-slot>
                            <x-slot name="description">
                                {{ __('Silahkan isi form untuk menambahkan penilaian baru.') }}
                            </x-slot>
                            <x-slot name="form">
                                <!-- Jenis Alternatif -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="id_alternatif" value="{{ __('Jenis Alternatif') }}" />
                                    <x-select id="id_alternatif" class="mt-1 block w-full" wire:model.defer="state.id_alternatif" autocomplete="id_alternatif">
                                        <option value="">--PILIH JENIS ALTERNATIF--</option>
                                        @foreach($dataAlternatif as $alternatif)
                                        <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->kode_alternatif }} ({{ $alternatif->jenis }})</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error for="state.id_alternatif" class="mt-2" />
                                </div>
                                <!-- Kriteria -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="id_kriteria" value="{{ __('Kriteria') }}" />
                                    <x-select id="id_kriteria" class="mt-1 block w-full" wire:model.defer="state.id_kriteria" autocomplete="id_kriteria">
                                        <option value="">--PILIH KRITERIA--</option>
                                        @foreach($dataKriteria as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}">{{ $kriteria->kode_kriteria }} ({{ $kriteria->nama_kriteria }})</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error for="state.id_kriteria" class="mt-2" />
                                </div>
                                <!-- Bobot -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="bobot" value="{{ __('Bobot') }}" />
                                    <x-input id="bobot" type="number" class="mt-1 block w-full" wire:model.defer="state.bobot" autocomplete="bobot" />
                                    <x-input-error for="state.bobot" class="mt-2" />
                                </div>
                            </x-slot>
                            <x-slot name="actions">
                                <x-action-message class="mr-3" on="penilaian.saved">
                                    {{ __('Berhasil menambahkan Penilaian baru !') }}
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
                                {{ __('Detail Penilaian') }}
                            </x-slot>
                            <x-slot name="description">
                                {{ __('Detail penilaian dan dapat mengeditnya.') }}
                            </x-slot>
                            <x-slot name="form">
                                <!-- Jenis Alternatif -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="id_alternatif" value="{{ __('Jenis Alternatif') }}" />
                                    <x-select disabled id="id_alternatif" class="mt-1 block w-full" wire:model.defer="detailPenilaian.id_alternatif" autocomplete="id_alternatif">
                                        <option value="">--PILIH JENIS ALTERNATIF--</option>
                                        @foreach($dataAlternatif as $alternatif)
                                        <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->kode_alternatif }} ({{ $alternatif->jenis }})</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error for="detailPenilaian.id_alternatif" class="mt-2" />
                                </div>
                                <!-- Kriteria -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="id_kriteria" value="{{ __('Kriteria') }}" />
                                    <x-select disabled id="id_kriteria" class="mt-1 block w-full" wire:model.defer="detailPenilaian.id_kriteria" autocomplete="id_kriteria">
                                        <option value="">--PILIH KRITERIA--</option>
                                        @foreach($dataKriteria as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}">{{ $kriteria->kode_kriteria }} ({{ $kriteria->nama_kriteria }})</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error for="detailPenilaian.id_kriteria" class="mt-2" />
                                </div>
                                <!-- Bobot -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="bobot" value="{{ __('Bobot') }}" />
                                    <x-input id="bobot" type="number" class="mt-1 block w-full" wire:model.defer="detailPenilaian.bobot" autocomplete="bobot" />
                                    <x-input-error for="detailPenilaian.bobot" class="mt-2" />
                                </div>
                            </x-slot>
                            <x-slot name="actions">
                                <x-action-message class="mr-3" on="penilaian.updated">
                                    {{ __('Berhasil update Penilaian !') }}
                                </x-action-message>
                                <x-action-message class="mr-3" on="penilaian.deleted">
                                    {{ __('Data Penilaian telah dihapus.') }}
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


    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
                <div class="flex items-center justify-between py-4">
                    <h1 class="w-auto text-3xl font-bold">Bobot Dari Setiap Alternatif</h1>
                </div>
                <hr>
                <div class="mt-8">
                    <div>
                        <x-table class="border-0">
                            <tr>
                                <x-th>Alternatif</x-th>
                                @foreach($dataKriteria as $kriteria)
                                <x-th>{{ $kriteria->kode_kriteria }}</x-th>
                                @endforeach
                            </tr>
                            @foreach($dataAlternatif as $index => $alternatif)
                            <tr>
                                <x-td>{{ $alternatif->kode_alternatif }} ({{ $alternatif->jenis }})</x-td>
                                @foreach($dataKriteria as $k)
                                    @php $tmp = false; @endphp
                                    @foreach($alternatif->kriteria as $kriteria)
                                        @if($kriteria->kode_kriteria == $k->kode_kriteria)
                                            @foreach($dataPenilaian as $penilaian)
                                                @if($penilaian->id_alternatif == $alternatif->id_alternatif && $penilaian->id_kriteria == $kriteria->id_kriteria)
                                                    <x-th>{{ $penilaian->bobot }}</x-th>
                                                    @php $tmp = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @if(!$tmp)
                                        <x-th></x-th>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
                <div class="flex items-center justify-between py-4">
                    <h1 class="w-auto text-3xl font-bold">Matriks Keputusan</h1>
                </div>
                <hr>
                <div class="mt-8">
                    <div>
                        <x-table class="border-0">
                            @foreach($dataAlternatif as $index => $alternatif)
                            <tr>
                                @if($index == 0)
                                <th rowspan="4" class="text-right pr-4">X = </th>
                                @endif
                                @foreach($dataKriteria as $k)
                                    @php $tmp = false; @endphp
                                    @foreach($alternatif->kriteria as $kriteria)
                                        @if($kriteria->kode_kriteria == $k->kode_kriteria)
                                            @foreach($dataPenilaian as $penilaian)
                                                @if($penilaian->id_alternatif == $alternatif->id_alternatif && $penilaian->id_kriteria == $kriteria->id_kriteria)
                                                    <x-th>{{ $penilaian->bobot }}</x-th>
                                                    @php $tmp = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @if(!$tmp)
                                        <x-th></x-th>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
                <div class="flex items-center justify-between py-4">
                    <h1 class="w-auto text-3xl font-bold">Matriks Normalisasi</h1>
                </div>
                <hr>
                <div class="mt-8">
                    <div>
                        <x-table class="border-0">
                            @foreach($dataAlternatif as $index => $alternatif)
                            <tr>
                                @if($index == 0)
                                <th rowspan="4" class="text-right pr-4">X = </th>
                                @endif
                                @foreach($dataKriteria as $k)
                                    @php $tmp = false; @endphp
                                    @foreach($alternatif->kriteria as $kriteria)
                                        @if($kriteria->kode_kriteria == $k->kode_kriteria)
                                            @foreach($dataPenilaian as $penilaian)
                                                @if($penilaian->id_alternatif == $alternatif->id_alternatif && $penilaian->id_kriteria == $kriteria->id_kriteria)
                                                    <x-th>
                                                        {{ $penilaian->bobot }} / 
                                                        {{ $kriteria->bobot }} = {{ round($penilaian->bobot / $kriteria->bobot, 2) }}
                                                    </x-th>
                                                    @php $tmp = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @if(!$tmp)
                                        <x-th></x-th>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
                <div class="flex items-center justify-between py-4">
                    <h1 class="w-auto text-3xl font-bold">Hasil Keseluruhan Perhitungan</h1>
                </div>
                <hr>
                <div class="mt-8">
                    <div>
                        <x-table class="border-0">
                            <tr>
                                <x-th>No</x-th>
                                <x-th>Alternatif</x-th>
                                <x-th>Hasil</x-th>
                                <x-th>Urutan</x-th>
                            </tr>
                            @foreach($dataHasil as $index => $hasil)
                            <tr>
                                <x-td class="text-center">{{ $index+1 }}</x-td>
                                <x-td>{{ $hasil->alternatif->kode_alternatif }} ({{ $hasil->alternatif->jenis }})</x-td>
                                <x-td>{{ $hasil->nilai }}</x-td>
                                <x-td class="text-center">{{ $hasil->urutan }}</x-td>
                            </tr>
                            @endforeach
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>