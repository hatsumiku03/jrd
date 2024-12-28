<title>Dashboard</title>
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-300 bg-[#747474]">
                @livewire('user-request-crew')
            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>
