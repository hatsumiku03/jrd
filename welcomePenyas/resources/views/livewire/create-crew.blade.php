<div x-data="{show: @entangle('crewCreation').live}" x-show="show" x-transition.opacity class="fixed inset-0 bg-black/50 flex items-center justify-center">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4">
            {{ session('message') }}
        </div>
    @endif


<div class="relative p-4 w-full max-w-md max-h-full">
    <div class="relative bg-[#404040] rounded-lg shadow" @click.away="show=false">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
            <h3 class="text-lg font-semibold text-white">
                Create New User
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
        <form wire:submit.prevent="createCrew()" class="p-4 md:p-5">

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

            {{-- Logo --}}
            <div class="mt-4">
                <x-label for="logo" value="{{ __('Logo') }}"
                    class="block mb-2 text-sm font-medium text-white" />
                <x-input id="logo"
                    class="bg-[#262626] border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    type="file" wire:model.defer="logo" />
                @error('logo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Slogan --}}
            <div class="mt-4">
                <x-label for="slogan" value="{{ __('Slogan') }}"
                    class="block mb-2 text-sm font-medium text-white" />
                <x-input id="slogan"
                    class="bg-[#262626] border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    type="text" wire:model.defer="slogan" />
                @error('slogan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Capacity of people --}}
            <div class="mt-4">
                <x-label for="capacity_people" value="{{ __('Capacidad de personas') }}"
                    class="block mb-2 text-sm font-medium text-white" />
                <x-input id="capacity_people"
                    class="bg-[#262626] border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    type="number" wire:model.defer="capacity_people" />
                @error('capacity_people')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Foundation date --}}
            <div class="mt-4">
                <x-label for="foundation_date" value="{{ __('Fecha de fundación') }}"
                    class="block mb-2 text-sm font-medium text-white" />
                <x-input id="foundation_date"
                    class="bg-[#262626] border border-gray-500 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    type="date" wire:model.defer="foundation_date" />
                @error('foundation_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Color --}}
            <div class="mt-4">
                <x-label for="color" value="{{ __('Color') }}" class="block mb-2 text-sm font-medium text-white" />
                <select id="color" wire:model.defer="color" class="bg-[#262626] rounded-xl border border-gray-500 text-white text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="">Select a color</option>
                    <option value="red-500">Red</option>
                    <option value="blue-500">Blue</option>
                    <option value="green-500">Green</option>
                    <option value="violet-500">Purple</option>
                    <option value="yellow-500">Yellow</option>
                </select>
                @error('color')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Crear') }}
                </x-button>
            </div>
        </form>

    </div>
</div>
</div>
