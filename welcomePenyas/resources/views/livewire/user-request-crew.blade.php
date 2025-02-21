<div>
	@if (session()->has('success'))
	<div class="m-1 bg-green-600 text-slate-300 p-1 rounded-md w-fit">{{ session('success') }}</div>
	@endif
	
	@if ($canRequest && Auth::user()->role_id == $regularUsers && $crews->count() > 0)      
	
	<p>Muy buenas caballer@, su primer paso para iniciarse en el mundillo de las peñas de la vall, le recomendamos encarecidamente que mire de unirse a alguna peña.
		<br>Aquí le dejamos un listado de peñas a las que puede unirse. haga click encima del nombre de una peña si quiere ver información extendida de la misma.
	</p>
	
	<ul class="m-2 ml-9 text-slate-200 list-disc">
		@foreach($crews as $crew)
		<li><span class="hover:underline hover:text-white cursor-pointer" wire:click='showCrewSlider=true'>{{ $crew->name }}</span></li>
		@endforeach
	</ul>

	<form class="max-w-sm mx-auto m-1" wire:submit.prevent="sendRequest">
		<input type="hidden" wire:model="userId">
		<label for="crew" class="block mb-2 text-sm font-medium text-white">¿A qué peña te gustaría unirte?</label>
		
		<select wire:model="crewId" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
			@foreach($crews as $crew)
			<option value="{{ $crew->id }}">{{ $crew->name }}</option>
			@endforeach
		</select>
		<x-button class="mt-4 mb-5" type="submit">Unirse</x-button>
	</form>
	
	@elseif(Auth::user()->role_id != $regularUsers)
	<p class="m-2">Hola señor administrador, ¿listo para un buen día de trabajo?</p>
	@elseif($crews->count() > 0)
	<p class="m-2">Buenos días señor@, {{ Auth::user()->name }}, que tal se encuentra?</p>
	
		@if(!$canRequest && !$inCrew)		
			<p class="m-2">Su solicitud de unión a la peña <span class="hover:underline hover:text-white cursor-pointer">{{ Auth::user()->request->crew->name}}</span> está pendiente de aprobación. 🔴</p>
		@else
			<p class="m-2">Actualmente forma parte de la peña <span class="hover:underline hover:text-white cursor-pointer">{{ $CrewOfTheUser }}</span> ✅</p>
		@endif

		@else
		<p class="m-2">Actualmente no disponemos de peñas en la página web, disculpe las molestias, en cuando hayan se abrirá en esta sección un pequeño formulario para que se pueda inscribir en la que usted desee.</p>
	@endif

	{{-- @livewire('slider-crew') --}}
</div>