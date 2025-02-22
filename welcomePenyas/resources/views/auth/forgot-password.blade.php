<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-400">
            {{ __('¿Has olvidado tu contraseña? No hay problema, tan solo escribe aquí tu email y te enviaremos un correo con un enlace para poder resetear la contraseña.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button>
                    {{ __('Enviar correo') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
