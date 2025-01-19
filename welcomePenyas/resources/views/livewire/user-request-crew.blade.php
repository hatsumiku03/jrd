<div>
	@if (session()->has('success'))
	<div>{{ session('success') }}</div>
	@endif
	
	@if ($canRequest && Auth::user()->role_id == $regularUsers)      
	
	<form class="max-w-sm mx-auto" wire:submit.prevent="sendRequest">
		<input type="hidden" wire:model="userId">
		
		<label for="crew" class="block mb-2 text-sm font-medium text-white">¿A qué peña te gustaría unirte?</label>
		<select wire:model="crewId" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
			@foreach($crews as $crew)
			<option value="{{ $crew->id }}">{{ $crew->name }}</option>
			@endforeach
		</select>
		<x-button type="submit">Unirse</x-button>
	</form>
	
	@elseif(Auth::user()->role_id != $regularUsers)
	<p>Recuerda cuál es tu trabajo :)</p>
	@else
	<p>Esperemos tengas un buen día ^^</p>
	@endif
</div>