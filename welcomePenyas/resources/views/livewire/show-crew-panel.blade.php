<div class="grid bg-[#525252]">
    <div class="py-4 pl-2">
        @if (session()->has('status'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <button type="button" wire:click="$parent.showCrewPanel" 
                class="text-white bg-[#262626] transition hover:bg-black focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><svg 
                    xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none" 
                    stroke="#f6f6f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H6M12 5l-7 7 7 7"/>
                </svg>
            </button>
        </div>
        
        <x-input type="text" wire:model.live="search" placeholder="Search a crew..." />

        {{-- Modify this with tailwind --}}
        <div>
            <button wire:click="createCrewPopup"
                class="w-fit mt-2 text-white bg-[#262626] transition hover:bg-red-800/60 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Crear una peña
            </button>
        </div>


        @livewire('create-crew', ['crewCreation' => $crewCreation])
                
    </div>
            <table class="w-full text-sm text-center rtl:text-center text-gray-400">
                <thead class="text-xs uppercase bg-[#171717] text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre 
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Logo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Slogan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Capacidad de personas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de fundación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                    </thead>
                <tbody>
            @foreach ($crews as $crew)
                <form>
                    @csrf
                    <tr class="border-b bg-[#525252] border-gray-700">

                        {{-- Name --}}
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            <input type="text" value="{{ $crew->name}}" class="w-full text-gray-100 bg-[#262626]" wire:model.defer="crewsData.{{ $crew->id }}.name">
                            @error('crewsData.{{ $crew->id }}.name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </th>

                        {{-- Logo --}}
                        <td class="px-6 py-4">
                            @if ($crew->logo)
                                <img src="{{ asset('storage/' . $crew->logo) }}" alt="Logo" class="w-16 h-16 object-cover">
                                <button type="button" wire:click="byeByeLogo({{ $crew->id }})" class="bg-red-600 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">Remove</button>
                            @endif
                            <input type="file" class="w-full text-gray-100 bg-[#262626]" wire:model="crewsData.{{ $crew->id }}.logo">
                        </td>

                        {{-- Slogan --}}
                        <td class="px-6 py-4">
                            <input type="text" value="{{ $crew->slogan}}" class="w-full text-gray-100 bg-[#262626]" wire:model.defer="crewsData.{{ $crew->id }}.slogan">
                        </td>

                        {{-- Capacity of people--}}
                        <td class="px-6 py-4">
                            <input type="number" value="{{ $crew->capacity_people }}" class="w-full text-gray-100 bg-[#262626]" wire:model.defer="crewsData.{{ $crew->id }}.capacity_people">
                        </td>
                        <td class="px-6 py-4">
                            <input type="date" value="{{ $crew->foundation_date }}" class="w-full text-gray-100 bg-[#262626]" wire:model.defer="crewsData.{{ $crew->id }}.foundation_date">
                        </td>

                        {{-- Color --}}
                        <td class="px-6 py-4 text-{{ $crew->color }}">
                            <select class="w-full bg-[#262626] rounded-xl" wire:model.defer="crewsData.{{ $crew->id }}.color"> 
                                    <option class="text-gray-400" value="">No selected</option>
                                    <option class="text-gray-400" value="red-500">Red</option>
                                    <option class="text-gray-400" value="blue-500">Blue</option>
                                    <option class="text-gray-400" value="green-500">Green</option>
                                    <option class="text-gray-400" value="violet-500">Purple</option>
                                    <option class="text-gray-400" value="yellow-500">Yellow</option>
                            </select>
                            @error('crewsData.{{ $crew->id }}.color') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>

                        {{-- Submit --}}
                        <td class="px-6 py-4">
                            <button wire:click='modify({{ $crew->id }})'
                                class="bg-[#262626] transition hover:bg-green-900/60 text-white font-bold py-2 px-4 rounded"><x-far-edit class="w-5 h-5" /></button>
                            </td>
                        <td class="px-6 py-4">
                            <button wire:click='remove({{ $crew->id }})' class="bg-[#262626] transition hover:bg-red-800/60 text-white font-bold py-2 px-4 rounded">
                                <x-zondicon-trash class="h-5 w-5" /></button>
                        </td>
                </form>
            @endforeach
        </tbody>
        </table>
        {{ $crews->links()}}
</div>
