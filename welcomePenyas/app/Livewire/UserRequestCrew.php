<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Crew;
use App\Models\Request;
use App\Models\UserCrew;
use Illuminate\Support\Facades\Auth;

class UserRequestCrew extends Component
{
    public $crews;
    public $CrewOfTheUser;

    public $RequestCrew;
    public $crewId;
    public $userId;
    public $canRequest = true;
    public $regularUsers = 2;
    public $inCrew = false;
    public $showCrewSlider = true;

    public function mount()
    {
        $this->crews = Crew::all();
        $this->CrewOfTheUser = Auth::user()->userCrew ? Auth::user()->userCrew->crew->name : null;
        $this->userId = auth()->user()->id;
        $this->crewId = $this->crews->isNotEmpty() ? $this->crews->first()->id : null;

        $activeUserRequest = Request::where('users_id', $this->userId)->exists();
        $activeUserCrew = UserCrew::where('user_id', $this->userId)->exists();

        if($activeUserCrew | $activeUserRequest){
            $this->canRequest = false;
        }
        
        if($activeUserCrew && !$activeUserRequest){
            $this->inCrew = true;
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
