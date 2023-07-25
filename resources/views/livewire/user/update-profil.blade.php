<div>
    <x-form-section submit="updateProfil">
        <x-slot name="title">
            {{ __('Profil') }}
        </x-slot>
        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
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
                <x-input disabled id="hak_akses" type="text" class="mt-1 block w-full" wire:model.defer="state.hak_akses" autocomplete="hak_akses" />
                <x-input-error for="state.hak_akses" class="mt-2" />
            </div>
            <!-- No Telepon -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="no_telepon" value="{{ __('No. Telepon') }}" />
                <x-input id="no_telepon" type="text" class="mt-1 block w-full" wire:model.defer="state.no_telepon" autocomplete="no_telepon" />
                <x-input-error for="state.no_telepon" class="mt-2" />
            </div>
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="email" />
                <x-input-error for="state.email" class="mt-2" />
            </div>
            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
                <x-input-error for="state.username" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-action-message class="mr-3" on="profil.saved">
                {{ __('Saved.') }}
            </x-action-message>
            <x-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
    <x-section-border />
    <div class="mt-10 sm:mt-0">
        <x-form-section submit="updatePassword">
            <x-slot name="title">
                {{ __('Update Password') }}
            </x-slot>
            <x-slot name="description">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="current_password" value="{{ __('Current Password') }}" />
                    <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="passwords.current_password" autocomplete="current-password" />
                    <x-input-error for="passwords.current_password" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="password" value="{{ __('New Password') }}" />
                    <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="passwords.password" autocomplete="new-password" />
                    <x-input-error for="passwords.password" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="passwords.password_confirmation" autocomplete="new-password" />
                    <x-input-error for="passwords.password_confirmation" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-action-message class="mr-3" on="password.saved">
                    {{ __('Saved.') }}
                </x-action-message>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
   {{--  <x-section-border />
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>
            <x-slot name="description">
                {{ __('Permanently delete your account.') }}
            </x-slot>
            <x-slot name="content">
                <div class="max-w-xl text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </div>
                <div class="mt-5">
                    <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
                <!-- Delete User Confirmation Modal -->
                <x-dialog-modal wire:model="confirmingUserDeletion">
                    <x-slot name="title">
                        {{ __('Delete Account') }}
                    </x-slot>
                    <x-slot name="content">
                        {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                            <x-input type="password" class="mt-1 block w-3/4" autocomplete="current-password" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />
                            <x-input-error for="password" class="mt-2" />
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </x-slot>
                </x-dialog-modal>
            </x-slot>
        </x-action-section> --}}
    </div>
</div>