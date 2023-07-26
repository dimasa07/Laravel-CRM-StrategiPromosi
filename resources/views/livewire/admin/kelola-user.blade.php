<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200" x-data="{ activeTab : 'data', deleted : false }">
            <div class="flex items-center justify-between py-4">
                <h1 class="w-auto text-3xl font-bold">Kelola User</h1>
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
                            <x-th>Nama</x-th>
                            <x-th>Jabatan</x-th>
                            <x-th>Username</x-th>
                            <x-th>Aksi</x-th>
                        </tr>
                        @foreach($dataUser as $index => $user)
                        <tr>
                            <x-td class="text-center">{{ $index+1 }}</x-td>
                            <x-td>{{ $user->nama_pengguna }}</x-td>
                            <x-td>{{ $user->hak_akses }}</x-td>
                            <x-td>{{ $user->username }}</x-td>
                            <x-td class="text-center">
                                <div class="inline-flex">
                                    <x-button-normal @click="activeTab = 'detail'; deleted = false" wire:click="detail({{ $user->id_user }})">
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
                    <x-form-section submit="tambahUser">
                        <x-slot name="title">
                            {{ __('Tambah User') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Silahkan isi form untuk menambahkan user baru.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_pengguna" value="{{ __('Nama') }}" />
                                <x-input id="nama_pengguna" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_pengguna" autocomplete="nama_pengguna" />
                                <x-input-error for="state.nama_pengguna" class="mt-2" />
                            </div>
                            <!-- Jabatan -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="hak_akses" value="{{ __('Jabatan') }}" />
                                <x-select id="hak_akses" class="mt-1 block w-full" wire:model.defer="state.hak_akses" autocomplete="hak_akses">
                                    <option value="Admin">Admin</option>
                                    <option value="PPSB">PPSB</option>
                                </x-select>
                                <x-input-error for="state.hak_akses" class="mt-2" />
                            </div>
                            <!-- Username -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="username" value="{{ __('Username') }}" />
                                <x-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
                                <x-input-error for="state.username" class="mt-2" />
                            </div>
                            <!-- Password -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="password" />
                                <x-input-error for="state.password" class="mt-2" />
                            </div>
                            <!-- Confirm Password -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="password_confirmation" />
                                <x-input-error for="state.password_confirmation" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="user.saved">
                                {{ __('Berhasil menambahkan User baru !') }}
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
                    <x-form-section submit="updateUser" >
                        <x-slot name="title">
                            {{ __('Detail User') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Detail user dan dapat mengeditnya.') }}
                        </x-slot>
                        <x-slot name="form">
                            <!-- Nama -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="nama_pengguna" value="{{ __('Nama') }}" />
                                <x-input id="nama_pengguna" type="text" class="mt-1 block w-full" wire:model.defer="detailUser.nama_pengguna" autocomplete="nama_pengguna" />
                                <x-input-error for="detailUser.nama_pengguna" class="mt-2" />
                            </div>
                            <!-- Jabatan -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="hak_akses" value="{{ __('Jabatan') }}" />
                                <x-select id="hak_akses" class="mt-1 block w-full" wire:model.defer="detailUser.hak_akses" autocomplete="hak_akses">
                                    <option value="Admin">Admin</option>
                                    <option value="PPSB">PPSB</option>
                                </x-select>
                                <x-input-error for="state.hak_akses" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-action-message class="mr-3" on="user.updated">
                                {{ __('Berhasil update User !') }}
                            </x-action-message>
                            <x-action-message class="mr-3" on="user.deleted">
                                {{ __('Data User telah dihapus.') }}
                            </x-action-message>
                            <div class="inline-flex" x-show="!deleted">
                                <x-button-info class="mx-2" type="submit" wire:loading.attr="disabled" wire:target="photo">
                                    {{ __('Ubah') }}
                                </x-button-info>
                                <x-button-danger type="button" wire:click="deleteUser" @click="deleted = true" wire:loading.attr="disabled" wire:target="photo">
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