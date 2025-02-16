<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-[#525252] p-6 lg:p-8 rounded-md">
                <h1 class="mt-2 text-3xl font-medium text-gray-200">
                    Generador de sorteo de peñas
                </h1>

                <!-- Botón de sorteo -->
                @if ($showDrawButton)
                    <x-button class="mt-6" wire:click="draw">Sortear</x-button>
                @else
                    <p class="mt-6 text-gray-200">El sorteo ya se ha realizado para este año.</p>
                    <x-button class="mt-6" wire:click="resetThisYearCrews">Reiniciar</x-button>
                @endif

                <!-- Mostrar mensajes de éxito o error -->
                @if (session('success'))
                    <div class="mt-6 p-4 bg-green-500 text-white rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mt-6 p-4 bg-red-500 text-white rounded">
                        {{ session('error') }}
                    </div>
                @endif
            @if ($showDraw)
            <div class="mt-6">
                <div class="border border-gray-400">
                    @for ($y = 0; $y < $MAX_HEIGHT; $y++)
                        <div class="flex">
                            @for ($x = 0; $x < $MAX_WIDTH; $x++)
                            <div class="border border-gray-400 p-10 text-center text-gray-200 w-full h-full bg-cover bg-center" style="background-image: url('{{ $grid[$y][$x] ? asset('storage/' . $grid[$y][$x]) : '' }}');" title="{{ $grid[$y][$x] ? $crewName[$y][$x] : '' }}">
                                @if(!$grid[$y][$x])
                                    <span></span>
                                @endif
                            </div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
            @endif
        </div>

        </div>
    </div>
</div>
