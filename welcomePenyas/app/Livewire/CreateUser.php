<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class CreateUser extends Component
{
    use WithFileUploads;

    // º User variables for the form º //
    public $name;
    public $surname;
    public $email;
    public $password;
    public $profile_photo_path;

    // º Role must refer to user table, and roles for the display of which role you want º //
    public $role;
    public $roles;

    // º Mount roles as a reference of the role table  º //
    public function mount()
    {
        $this->roles = Role::all();
    }

    // º Rules for the creation º //
    protected $rules = [
        'name' => 'required|string|max:255',
        'surname' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
        'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            // ! Profile photo se guarda en donde debería, pero en la base de datos no guarda el string... ! //
            'role_id' => $this->role,
        ]);

        session()->flash('message', 'User created successfully.');

        $this->reset(['name', 'surname', 'email', 'password', 'profile_photo_path', 'role']);
    }

    // º Render by default º //
    public function render()
    {
        return view('livewire.create-user');
    }
}