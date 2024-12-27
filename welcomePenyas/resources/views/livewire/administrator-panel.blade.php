<div>
    @if ($crewPanel)
    <div>
        @livewire('show-crew-panel')
    </div>
    @elseif ($userPanel)
        @livewire('show-user-panel')
    @else
    <div class="bg-gray-800 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    
        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9C9DA4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h2 class="ms-3 text-xl font-semibold text-white">
                    <div>
                        <button wire:click="showUserPanel">Panel de usuarios</button>
                    </div>
                </h2>
            </div>
    
            <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                Gestiona a los usuarios.
            </p>
        </div>
        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9C9DA4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/>
                </svg>
                <h2 class="ms-3 text-xl font-semibold text-white">
                    <div>
                        <button wire:click="showCrewPanel">Panel de peñas</button>
                    </div>
                </h2>
            </div>
    
            <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                Gestiona a las peñas.
            </p>
        </div>
    </div>
        @endif
</div>
