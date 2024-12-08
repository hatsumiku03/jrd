<?php

namespace App\Livewire;

use App\Models\Crew;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCrew extends Component
{
    use WithFileUploads;

    public $crewCreation;

    // º Crew variables º //
    public $name;
    public $logo;
    public $slogan;
    public $capacity_people;
    public $foundation_date;
    public $color;


    // º Mount all º //
    public function mount($crewCreation){
        $this->crewCreation = $crewCreation;
    }

    // º True or false to toggle the create crew panel º //
    #[On('crew-create')]
    public function userCreate(){
        $this->crewCreation = true;
    }

    // º Rules for the creation º //
    protected $rules = [
        'name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'slogan' => 'nullable|string|max:255',
        'capacity_people' => 'required|integer|min:1',
        'foundation_date' => 'required|date',
        'color' => 'nullable|string',
    ];

        
    // º Rules for the creation º //
    public function createCrew(){
        $this->validate();

        if($this->logo){
            $logoPath = $this->logo->store('crews', 'public');
        }else{
            $logoPath = null;
        }

        Crew::create([
            'name' => $this->name,
            'logo' => $logoPath,
            'slogan' => $this->slogan,
            'capacity_people' => $this->capacity_people,
            'foundation_date' => $this->foundation_date,
            'color' => $this->color,
        ]);

        session()->flash('message', 'User created successfully.');

        $this->reset();
    }
    
    public function render()
    {
        $crews = Crew::all();
        return view('livewire.create-crew', ['crews' => $crews]);
    }
}
