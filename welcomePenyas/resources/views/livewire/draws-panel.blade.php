<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-[#525252] p-6 lg:p-8 rounded-md">
                <h1 class="mt-2 text-3xl font-medium text-gray-200">
                    Generador de sorteo de peñas
                </h1>

                <!-- Draw Button -->
                @if ($showDrawButton)
                    <x-button class="mt-6" wire:click="draw">Sortear</x-button>
                @else
                    <p class="mt-6 text-gray-200">El sorteo ya se ha realizado para este año.</p>
                    <x-button class="mt-6" wire:click="resetThisYearCrews">Reiniciar</x-button>
                @endif
                
                <!-- Session messages -->
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

            <!-- Draw display -->
            @if ($showDraw)
            <div class="mt-6">
                <div class="border border-gray-400">
                    @for ($y = 0; $y < $MAX_HEIGHT; $y++)
                        <div class="flex">
                            @for ($x = 0; $x < $MAX_WIDTH; $x++)
                            <div class="border border-gray-400 p-10 text-gray-200 w-full h-full bg-cover bg-center align-center relative" 
                            style="background-image: url('{{ $grid[$y][$x] ? asset('storage/' . $grid[$y][$x]) : '' }}');" title="{{ $grid[$y][$x] ? $crewName[$y][$x] : '' }}">
                                @if(!$grid[$y][$x])
                                    <span class="absolute inset-0 flex items-center justify-center">{{$crewName[$y][$x] }}</span>
                                @endif
                            </div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
            @endif
            <!-- End of the draw display -->

            <!-- Saw other year draws -->
            <div class="text-center text-gray-100">
                <hr class="mt-12">
                <h1 class="text-6xl mt-5">Vista de sorteos de años anteriores</h1>
                <select wire:model="selectedYear" id="year" wire:change="showSelectedYearDraw" class="mt-4 text-black text-center">
                    <option value="">Seleccione un año</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                @if(!$selectedDraw && $selectedYear == '')
                <h3 class="mt-2 text-xl">Selecciona un año :3</h3>
                @else
                    <h3 class="mt-2 text-xl">Sorteos del año {{ $selectedYear }}</h3>
                @endif
            </div>
        
            <!-- Display -->
            @if($selectedDraw && $selectedYear != '')
                <div class="mt-6">
                    <div class="border border-gray-400">
                        @for ($y = 0; $y < $MAX_HEIGHT; $y++)
                            <div class="flex">
                                @for ($x = 0; $x < $MAX_WIDTH; $x++)
                                <div class="border border-gray-400 p-10 text-gray-200 w-full h-full bg-cover bg-center align-center relative" 
                                style="background-image: url('{{ $selectedCrewLogo[$y][$x] ? asset('storage/' . $selectedCrewLogo[$y][$x]) : '' }}');" title="{{ $selectedCrewLogo[$y][$x] ? $selectedName[$y][$x] : '' }}">
                                    @if(!$selectedCrewLogo[$y][$x])
                                        <span class="absolute inset-0 flex items-center justify-center">{{$selectedName[$y][$x] }}</span>
                                    @endif
                                </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
                @else
            @endif
            <!--End of the saw other year crews -->
        </div>

        </div>
    </div>
</div>