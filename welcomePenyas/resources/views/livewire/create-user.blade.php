<div x-data="{show: @entangle('userCreation').live}" x-show="show" x-transition.opacity class="fixed inset-0 bg-black/50 flex items-center justify-center">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4">
            {{ session('message') }}
        </div>
    @endif


    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-[#404040] rounded-lg shadow" @click.away="show=false">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-lg font-semibold text-white">
                    Crear un nuevo usuario
                </h3>
                <button @click="show = false"
                    class="text-gray-400 bg-transparent hover:bg-gray-600 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form wire:submit.prevent="createUser" class="p-4 md:p-5">

                {{-- Name --}}
                <div class="mt-4">
                    <x-label for="name" value="{{ __('Nombre') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <x-input id="name"
                        class="bg-[#262626] border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        type="text" wire:model.defer="name" required />
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Surname --}}
                <div class="mt-4">
                    <x-label for="surname" value="{{ __('Apellidos') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <x-input id="surname"
                        class="bg-[#262626]  border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        type="text" wire:model.defer="surname" />
                    @error('surname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <x-input id="email"
                        class="bg-[#262626]  border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        type="email" wire:model.defer="email" />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Contraseña') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <x-input id="password"
                        class="bg-[#262626]  border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        type="password" wire:model.defer="password" required />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Profile Photo --}}
                <div class="mt-4">
                    <x-label for="profile_photo_path" value="{{ __('Foto de perfil') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <x-input id="profile_photo_path"
                        class="w-full"
                        type="file" wire:model="profile_photo_path" />
                    @error('profile_photo_path')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mt-4">
                    <x-label for="role" value="{{ __('Rol') }}"
                        class="block mb-2 text-sm font-medium text-white" />
                    <select id="role"
                        class="bg-[#262626] rounded-xl border border-gray-500 text-white text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        wire:model.defer="role" required>
                        <option value="">{{ __('Select Role') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <x-button>
                        {{ __('Crear') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>
