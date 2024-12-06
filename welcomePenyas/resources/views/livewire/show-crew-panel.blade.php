<div>
    <div class="py-4 pl-2">
        
        <div>
            <button type="button" wire:click="$parent.showCrewPanel" class="text-white bg-gray-900 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none" stroke="#f6f6f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H6M12 5l-7 7 7 7"/></svg></button>
        </div>
        
        <x-input type="text" wire:model.live="search" placeholder="Search a crew..." />
                
    </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name 
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Logo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Slogan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Capacity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Foundation
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Save
                        </th>
                    </tr>
                    </thead>
                <tbody>
            @foreach ($crews as $crew)
                <form>
                    @csrf
                    <tr class="border-b bg-gray-800 border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            <input type="text" value="{{ $crew->name}}" class="w-full bg-gray-800 border-none" wire:model.defer="crewsData.{{ $crew->id }}.name">
                            @error('crewsData.{{ $crew->id }}.name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </th>
                        <td class="px-6 py-4">
                            @if ($crew->logo)
                                <img src="{{ asset('storage/' . $crew->logo) }}" alt="Logo" class="w-16 h-16 object-cover">
                                <button type="button" wire:click="removeLogo({{ $crew->id }})" class="bg-red-600 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">Remove</button>
                            @endif
                            <input type="file" class="w-full bg-gray-800 border-none" wire:model="crewsData.{{ $crew->id }}.logo">
                            @error('crewsData.{{ $crew->id }}.logo') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" value="{{ $crew->slogan}}" class="w-full bg-gray-800 border-none" wire:model.defer="crewsData.{{ $crew->id }}.slogan">
                            @error('crewsData.{{ $crew->id }}.slogan') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" value="{{ $crew->capacity_people }}" class="w-full bg-gray-800 border-none" wire:model.defer="crewsData.{{ $crew->id }}.capacity_people">
                            @error('crewsData.{{ $crew->id }}.capacity_people') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>
                        <td class="px-6 py-4">
                            <input type="date" value="{{ $crew->foundation_date }}" class="w-full bg-gray-800 border-none" wire:model.defer="crewsData.{{ $crew->id }}.foundation_date">
                            @error('crewsData.{{ $crew->id }}.foundation_date') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>
                        <td class="px-6 py-4 text-{{ $crew->color }}">
                            <select class="w-full bg-gray-800 border-none" wire:model.defer="crewsData.{{ $crew->id }}.color"> 
                                    <option class="text-gray-400" value="">No selected</option>
                                    <option class="text-gray-400" value="red-500">Red</option>
                                    <option class="text-gray-400" value="blue-500">Blue</option>
                                    <option class="text-gray-400" value="green-500">Green</option>
                                    <option class="text-gray-400" value="violet-500">Purple</option>
                                    <option class="text-gray-400" value="yellow-500">Yellow</option>
                            </select>
                            @error('crewsData.{{ $crew->id }}.color') <span class="text-red-500">{{ $message }}</span> @enderror
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click='modify({{ $crew->id }})' class="bg-gray-600 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Modify</button>
                        </td>
                </form>
            @endforeach
        </tbody>
        </table>
        {{ $crews->links()}}
</div>
