<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        'userData.*.name.required' => 'You must gave a name!!!11.', 
        'userData.*.email.required' => 'You must put here a email dumbass.', 
        // ! Add more custom messages as needed 
    ];


    // º Emit AdministratorPanel to create an user º //
    public function createUserPopup(){
        $this->dispatch('user-create');
        // $this->userCreation = !$this->userCreation;
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

        // ! I want a check status when you update modfiers, this is if you check the user isn't admin, instant out on the page
        $this->resetPage();
    }

    

    // º Render and pagination º//
    public function render()
    {
        $roles = Role::all();
        
        // | Consulta | //
        $users = User::where('name', 'like', '%'.$this->search.'%')->paginate(perPage: 10);

        return view('livewire.show-user-panel')
        ->with(['users' => $users, 'roles' => $roles]);
    }
}