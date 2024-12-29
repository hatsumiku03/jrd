<x-action-section>
    <x-slot name="title">
        {{ __('Borrar cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Al darle aquí están borrando tu cuenta de forma permanente.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-300">
            {{ __('Una vez eliminada tu cuenta, todos los recursos y datos de esta se perderan permanentemente. Antes de eliminar tu cuenta, descarga los datos o la información que desees conservar.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Borrar cuenta') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Borrar cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Está seguro de que quieres eliminar tu cuenta? Una vez eliminada tu cuenta, todos los recursos y datos se borrarán permanentemente. Por favor, introduce tu contraseña para confirmar la eliminación permanentemente tu cuenta.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Introduce tu contraseña...') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Borrar cuenta') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
