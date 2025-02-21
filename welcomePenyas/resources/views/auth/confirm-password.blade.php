<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-300">
            {{ __('Por favor, confirma tu contraseña') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <button class="bg-[#262626] transition hover:bg-red-800/60 text-white font-bold py-2 px-4 rounded">
                    {{ __('Confirmar') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
