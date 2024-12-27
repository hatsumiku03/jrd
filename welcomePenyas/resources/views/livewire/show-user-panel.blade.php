<div class="grid bg-gray-800">
    <div class="py-4 pl-2">
        @if (session()->has('status'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <button type="button" wire:click="$parent.showUserPanel"
                class="text-white bg-gray-900 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none"
                    stroke="#f6f6f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H6M12 5l-7 7 7 7"/>
                </svg>
            </button>
        </div>
        
        <x-input type="text" wire:model.live="search" placeholder="Search a user..." />
        <p class="text-white"> {{ $search }}</p>

        {{-- Modify this with tailwind --}}
        <div>
            <button wire:click="createUserPopup"
                class="w-fit mt-2 text-white bg-gray-900 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Create User
            </button>
        </div>


        @livewire('create-user', ['userCreation' => $userCreation])



    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
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
                    Guardar
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <form>
                    @csrf
                    <tr class="border-b bg-gray-800 border-gray-700">
                        
                        {{-- Name --}}
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            <input placeholder="Inserta un nombre" type="text" class="w-full bg-gray-800 border-none" value="{{ $user->name }}"
                                wire:model.defer="userData.{{ $user->id }}.name">
                            <div class="text-red-500">
                                @error('userData.{{ $user->id }}.name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </th>

                        {{-- Surname --}}
                        <td class="px-6 py-4">
                            <input placeholder="Inserta un apellido" type="text" class="w-full bg-gray-800 border-none"
                                value="{{ $user->surname }}" wire:model.defer="userData.{{ $user->id }}.surname">
                        </td>

                        {{--- Email --}}
                        <td class="px-6 py-4">
                            <input placeholder="Inserta un email" type="text" class="w-full bg-gray-800 border-none" value="{{ $user->email }}"
                                wire:model.defer="userData.{{ $user->id }}.email">
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4 {{ $user->role_id == 1 ? 'text-green-600' : 'text-orange-500' }}">
                            <select class="w-full bg-gray-800 border-none"
                                wire:model.defer="userData.{{ $user->id }}.role_id">
                                @foreach ($roles as $role)
                                    <option class="text-gray-400" value="{{ $role->id }}">{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        @if ($user->pendingRequest())
                            <td class="px-6 py-4">
                                <button wire:click="requestAccept({{ $user->id }})"
                                    class="text-white bg-gray-900 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Add
                                </button>
                            </td>
                        @elseif ($user->inCrew())
                        <td class="px-6 py-4">
                                <div class="text-{{$user->userCrew->crew->color}}">
                                    {{ $user->userCrew->crew->name }}
                                </div>
                        </td>
                        @else
                        <td class="px-6 py-4">
                            <p>No pertenece a ninguna peña</p>
                        </td>
                        @endif

                        {{-- Submit --}}
                        <td class="px-6 py-4">
                            <button wire:click='modify({{ $user->id }})'
                                class="bg-gray-600 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Modify</button>
                        </td>
                </form>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
