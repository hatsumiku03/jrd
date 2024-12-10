<?php

namespace App\Livewire;

use App\Models\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCrew;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserPanel extends Component
{
    use WithPagination;

    public $search = '';

    public $userCreation = false;

    // º User parameters º //
    public $userData = [];


    // º Mount the user database data by id º //
    public function mount(){
        $this->userData = User::all()->keyBy('id')->toArray();

    }


    // º Error messages (working) º //
    protected $messages = [ 
        'userData.*.name.required' => 'Has de poner un nombre', 
        'userData.*.email.required' => 'Has de poner un email', 
    ];


    // º Emit AdministratorPanel to create an user º //
    public function createUserPopup(){
        $this->dispatch('user-create');
    }


    // º Create users in the panel (working) º //
    public function save(){
        User::create(
            $this->only('name', 'surname', 'email', 'role_id')
        );
    }


    // º Modify method for update the users º //
    public function modify($id)
    {
        $validated = $this->validate([
            'userData.'.$id.'.name' => 'required|string|min:1|max:50', 
            'userData.'.$id.'.surname' => 'nullable|string|max:56', 
            'userData.'.$id.'.email' => 'required|email|max:100',
        ]);
        
        $user = User::find($id);
        
        $user->update($this->userData[$id]);

        session()->flash('status', 'El usuario ' . $user->name . ' ha sido modificado correctamente');
    }

    public function requestAccept($userId)
    {
        $user = User::find($userId);
        $request = $user->request()->first();

        if ($request) {
            
            UserCrew::create([
                'user_id' => $user->id,
                'crew_id' => $request->crews_id,
                ]);
            }
        $request->delete();
    }

    // º Render and pagination º//
    public function render()
    {
        $roles = Role::all();
        
        // | Consulta | //
        $users = User::where('name', 'like', '%'.$this->search.'%')->paginate(10, ['*'], 'users');

        return view('livewire.show-user-panel')
        ->with(['users' => $users, 'roles' => $roles]);
    }
}