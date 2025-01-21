<div class="grid bg-[#525252]">
    <div class="py-4 pl-2">
        @if (session()->has('status'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <button type="button" wire:click="$parent.showUserPanel"
                class="text-white bg-[#262626] transition hover:bg-black focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none"
                    stroke="#f6f6f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H6M12 5l-7 7 7 7"/>
                </svg>
            </button>
        </div>
        
        <x-input type="text" wire:model.live="search" placeholder="Busca un usuario..." />
        {{-- <p class="text-white"> {{ $search }}</p> --}}

        {{-- Modify this with tailwind --}}
        <div>
            <button wire:click="createUserPopup"
                class="w-fit mt-2 text-white bg-[#262626] transition hover:bg-red-800/60 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Crear un usuario
            </button>
        </div>


        @livewire('create-user', ['userCreation' => $userCreation])



    </div>
    <table class="w-full text-sm text-center rtl:text-center text-gray-400">
        <thead class="text-xs uppercase bg-[#171717] text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Apellido
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Rol
                </th>
                <th scope="col" class="px-6 py-3">
                    Peña
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                <form>
                    @csrf
                    <tr class="border-b bg-[#525252] border-gray-700">
                        
                        {{-- Name --}}
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            <input placeholder="Inserta un nombre" type="text" class="w-full text-gray-100 bg-[#262626] rounded placeholder-gray-400" value="{{ $user->name }}"
                                wire:model.defer="userData.{{ $user->id }}.name">
                            <div class="text-red-500">
                                @error('userData.{{ $user->id }}.name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </th>

                        {{-- Surname --}}
                        <td class="px-6 py-4">
                            <input placeholder="Inserta un apellido" type="text" class="w-full text-gray-100 bg-[#262626] rounded placeholder-gray-400"
                                value="{{ $user->surname }}" wire:model.defer="userData.{{ $user->id }}.surname">
                        </td>

                        {{--- Email --}}
                        <td class="px-6 py-4">
                            <input placeholder="Inserta un email" type="text" class="w-full text-gray-100 bg-[#262626] rounded placeholder-gray-400" value="{{ $user->email }}"
                                wire:model.defer="userData.{{ $user->id }}.email">
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4 {{ $user->role_id == 1 ? 'text-green-400' : 'text-orange-400' }}">
                            <select class="w-full bg-[#262626] rounded-xl"
                                wire:model.defer="userData.{{ $user->id }}.role_id">
                                @foreach ($roles as $role)
                                    <option class="text-gray-300" value="{{ $role->id }}">{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        @if ($user->pendingRequest())
                            <td class="px-6 py-4 text-center">
                                <button wire:click="requestAccept({{ $user->id }})"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Add
                                </button>
                            </td>
                        @elseif ($user->inCrew())
                        <td class="px-6 py-4">
                                <div class="bg-[#262626] rounded text-center mx-11 text-{{$user->userCrew->crew->color ?? 'gray-200' }}">
                                    {{ $user->userCrew->crew->name }}
                                </div>
                        </td>
                        @else
                        <td class="px-6 py-4 text-gray-100">
                            <p>No pertenece a ninguna peña</p>
                        </td>
                        @endif

                        {{-- Submit --}}
                        <td class="px-6 py-4">
                                <button wire:click='modify({{ $user->id }})'
                                    class="bg-[#262626] transition hover:bg-blue-900/60 text-white font-bold py-2 px-4 rounded"><x-far-edit class="w-5 h-5" /></button>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click='remove({{ $user->id }})' class="bg-[#262626] transition hover:bg-red-800/60 text-white font-bold py-2 px-4 rounded">
                                <x-zondicon-trash class="h-5 w-5" /></button>
                        </td>
                </form>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
