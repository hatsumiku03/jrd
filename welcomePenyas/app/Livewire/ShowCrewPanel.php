<?php

namespace App\Livewire;

use App\Models\Crew;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowCrewPanel extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $crewCreation = false;
    public $crewsData = [];

    public function mount() 
    {
        $this->crewsData = Crew::all()->keyBy('id')->toArray();
    }

    // º Toggle the crew creation panel º //
    public function createCrewPopup() 
    {
        $this->dispatch('crew-create');
    }

    // º Modify the values in pagination º //
    public function modify($id) 
    { 
        $validated = $this->validate([
            'crewsData.'.$id.'.name' => 'required|string|min:1|max:50', 
            'crewsData.'.$id.'.logo' => 'nullable|image|mimes:jpg,svg,png|max:1024', 
            'crewsData.'.$id.'.slogan' => 'nullable|string|max:100',
            'crewsData.'.$id.'.capacity_people' => 'required|integer|min:0',
            'crewsData.'.$id.'.foundation_date' => 'nullable|date|after_or_equal:1950-01-01',
        ]);

        // Esto es una verificación en el que comprobamos que la variable crewData no sea null y se este
        // pillando la ruta del archivo bien, y por otra parte, el is_object es un campo opcional
        // para asegurarnos 100% de que en ningún caso se pueda subir un archivo que no sea una imagen
        if (isset($this->crewsData[$id]['logo']) && is_object($this->crewsData[$id]['logo'])) {
            $logoPath = $this->crewsData[$id]['logo']->store('crews', 'public');
            $this->crewsData[$id]['logo'] = $logoPath;
        }

        if($this->crewsData[$id]['color']== '') {
            $this->crewsData[$id]['color'] = null;
        }

        
        $crew = Crew::find($id);
        $crew->update($this->crewsData[$id]);
        session()->flash('status', 'La peña ' . $crew->name . ' fue actualizada correctamente.');
    }

    public function remove($id){
        $crew = Crew::find($id);
        $crew->delete();
    }


    // º Remove the logo of a crew º //
    public function byeByeLogo($id)
    {
        $crew = Crew::find($id);

        if ($crew && $crew->logo) {
            Storage::disk('public')->delete($crew->logo);
            $this->crewsData[$id]['logo'] = null;
            $crew->logo = null;
            $crew->save();
        }
    }

    public function render()
    {
        $crews = Crew::where('name', 'like', '%'.$this->search.'%')->paginate(10, ['*'], 'crews');
        return view('livewire.show-crew-panel', ['crews' => $crews]);
    }
}
