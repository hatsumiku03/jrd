<div>
    @if (session()->has('success'))
    <div>{{ session('success') }}</div>
    @endif


    
    @if ($canRequest && Auth::user()->role_id == $regularUsers)      
    <h2>Join a Crew</h2>

    <form wire:submit.prevent="sendRequest">
        <input type="hidden" wire:model="userId">
        
        <label for="crew">Selecciona a que peña quieres unirte:</label>

        <select wire:model="crewId" id="crew" class="text-black">
            <option value="">-- Selecciona una peña --</option>
            @foreach($crews as $crew)
                <option value="{{ $crew->id }}">{{ $crew->name }}</option>
            @endforeach
        </select>
        
        <button type="submit">Join Crew</button>
    </form>
    @elseif(Auth::user()->role_id != $regularUsers)
        <p>Recuerda cuál es tu trabajo :)</p>
    @else
        <p>Esperemos tengas un buen día ^^</p>
    @endif
</div>