<div class="w-full h-full flex items-center justify-center bg-[#727272] flex-col">

    <!-- Message -->
    @if (session()->has('message'))
      <div class="bg-green-500 text-white p-4 rounded-md mt-4">
          {{ session('message') }}
      </div>
    @endif

    <div class="flex flex-col text-white">
        <h1 class="text-3xl font-bold mt-5 mb-1">Formulario de contacto</h1>
    </div>

    <div class="text-center text-white">
        <p>Consultenos y con la mayor brevedad posible le contactaremos si hay alguna incidencia <br>web o tiene alguna otra cuestión relacionada con las peñas.</p>
    </div>

    <div class="w-full max-w-md">
        <form wire:submit.prevent="submit" class="bg-[#131313] shadow-md rounded-md px-12 pt-6 pb-8 mb-12 mt-5">

          <!-- Name -->
          <div class="mb-4">
            <x-label class="mb-2" for="name">
              Nombre
            </x-label>
            <x-input wire:model='name' class="w-full" id="name" type="text" placeholder="Inserta tu nombre..."></x-input>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>  

          <!-- Email -->
          <div class="mb-4">
            <x-label class="mb-2" for="mail">
              Correo
            </x-label>
            <x-input wire:model='email' class="w-full" id="mail" type="text" placeholder="Inserta tu correo..."></x-input>
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
          
          <!-- Message -->
          <div class="mb-4">
            <x-label class="mb-2" for="message">
              Mensaje
            </x-label>
            <textarea wire:model='message' name="message" id="message" rows="3" class="border-gray-400 w-full bg-[#262626] text-gray-300 focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm placeholder-gray-300'"></textarea>
            @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
          
          <!-- Submit Button -->
          <div class="flex items-center justify-center">
            <x-button>
              Enviar
            </x-button>
          </div>
        </form>
      </div>
    </div>
</div>