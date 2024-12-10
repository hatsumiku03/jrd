<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\On; 

class CreateUser extends Component
{
    use WithFileUploads;

    public $userCreation;

    // º User variables º //
    public $name;
    public $surname;
    public $email;
    public $password;
    public $profile_photo_path;
    public $role;


    // º True or false to toggle the create user panel º //
    #[On('user-create')]
    public function userCreate(){
        $this->userCreation = true;
    }

    // º Rules for the creation º //
    protected $rules = [
        'name' => 'required|string|max:255',
        'surname' => 'nullable|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'role' => 'required|exists:roles,id',
    ];

    // º Create user form logic º //
    public function createUser()
    {
        $this->validate();

        if($this->profile_photo_path){
            $profilePhotoPath = $this->profile_photo_path->store('profile-photos', 'public');
        }else{
            $profilePhotoPath = null;
        }

        User::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'profile_photo_path' => $profilePhotoPath,
            'role_id' => $this->role,
        ]);

        session()->flash('message', 'User created successfully.');

        $this->reset(['name', 'surname', 'email', 'password', 'profile_photo_path', 'role']);
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.create-user', ['roles' => $roles]);
    }
}