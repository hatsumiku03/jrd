<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Crew;
use App\Models\Request;
use App\Models\UserCrew;

class UserRequestCrew extends Component
{
    public $crews;
    public $crewId;
    public $userId;
    public $canRequest = true;
    public $regularUsers = 2;

    public function mount()
    {
        $this->crews = Crew::all();
        $this->userId = auth()->user()->id;

        $activeUserRequest = Request::where('users_id', $this->userId)->exists();
        $activeUserCrew = UserCrew::where('user_id', $this->userId)->exists();

        // Esto se ha de cambiar ya que quiero separar el mensaje de esperando aunirse a una peña, y un
        // display de que ya estas en una peña
        if($activeUserCrew | $activeUserRequest){
            $this->canRequest = false;
        }
    }

    public function sendRequest()
    {
        Request::create([
            'users_id' => $this->userId,
            'crews_id' => $this->crewId,
        ]);

        session()->flash('success', 'Tu solicitud ha sido enviada correctamente');
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.user-request-crew');
    }
}
