<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Crew;
use App\Models\Location;

class DrawsPanel extends Component
{
    public $MAX_WIDTH = 10;
    public $MAX_HEIGHT = 10;
    public $actualYear;
    public $grid = [];
    public $crewName = [];
    public $showDrawButton = true;
    public $showDraw = false;

    // | Select variables | //
    public $selectedYear;
    public $years = [];
    public $selectedCrewLogo = [];
    public $selectedDraw = [];
    public $selectedName = [];

    public function mount()
    {
        $this->actualYear = now()->year;
        $this->loadGrid();
        $this->years = Location::distinct()->pluck('year')->toArray();
    }

    // For the selected year, show the draw of other years
    public function showSelectedYearDraw()
    {
        if ($this->selectedYear) {
            $locations = Location::where('year', $this->selectedYear)->with('crew')->get();
            $this->selectedDraw = $locations;
            $this->selectedCrewLogo = array_fill(0, $this->MAX_HEIGHT, array_fill(0, $this->MAX_WIDTH, null));
            $this->selectedName = array_fill(0, $this->MAX_HEIGHT, array_fill(0, $this->MAX_WIDTH, null));

            foreach ($locations as $location) {
                if ($location->crew && $location->crew->isNotEmpty()) {
                    $this->selectedCrewLogo[$location->y][$location->x] = $location->crew->first()->logo;
                    $this->selectedName[$location->y][$location->x] = $location->crew->first()->name;
                }
            }
        }
    }
    
    // With the grid variable, you load the actual draw in a query
    public function loadGrid()
    {
        $locations = Location::where('year', $this->actualYear)->with('crew')->get();
        
        $this->grid = array_fill(0, $this->MAX_HEIGHT, array_fill(0, $this->MAX_WIDTH, null));
        $this->crewName = array_fill(0, $this->MAX_HEIGHT, array_fill(0, $this->MAX_WIDTH, null));
        
        
        // Disable the buttons
        if ($locations->count() > 0) {
            $this->showDrawButton = false;
            $this->showDraw = true;
        }
    
        foreach ($locations as $location) {
            if ($location->crew && $location->crew->isNotEmpty()) {
                $this->grid[$location->y][$location->x] = $location->crew->first()->logo;
                $this->crewName[$location->y][$location->x] = $location->crew->first()->name;
            }
        }
    }
    
    // The logic for send the draw data to the database, nothing else
    public function draw()
    {
        // Obtener todas las peñas
        $crews = Crew::all();
    
        // Verificar si hay peñas disponibles
        if ($crews->count() === 0) {
            session()->flash('error', 'No hay peñas disponibles para realizar el sorteo.');
            return;
        }
    
        // Generar coordenadas aleatorias que no se repiten para cada peña
        $places = [];
        foreach ($crews as $crew) {
            $isValidCoord = false;
            while (!$isValidCoord) {
                $x = rand(0, $this->MAX_WIDTH - 1);
                $y = rand(0, $this->MAX_HEIGHT - 1);
                $coord = [$x, $y];
                $isValidCoord = $this->validCoords($coord, $places);
                if ($isValidCoord) {
                    $places[$crew->id] = $coord;
                }
            }
        }
        
        
        foreach ($places as $crewId => $coord) {
            $location = Location::create([
                'x' => $coord[0],
                'y' => $coord[1],
                'year' => $this->actualYear,
            ]);
    
            $location->crew()->attach($crewId);
        }
    
        $this->loadGrid();
        $this->showDrawButton = false;
        $this->showDraw = true;
        $this->years = Location::distinct()->pluck('year')->toArray();
        session()->flash('success', 'Sorteo realizado ✅');
        return redirect()->route('raffle');
    }

    // The logic for reset the actual draw if do you want
    public function resetThisYearCrews(){
        $locations = Location::where('year', $this->actualYear)->get();

        foreach ($locations as $location) {
            $location->crew()->detach();
            $location->delete();
        }
    
        $this->loadGrid();
        $this->showDrawButton = true;
        $this->showDraw = false;

        $this->years = Location::distinct()->pluck('year')->toArray();

        // Restablecer la selección del año si el año actual se ha eliminado
        if (!in_array($this->actualYear, $this->years)) {
            $this->selectedYear = null;
        }

        session()->flash('success', 'Sorteo reiniciado ✅');
        return redirect()->route('raffle');
    }

    // This is a variable for validate the coordinates, in work per now
    private function validCoords($coord, $places)
    {
        return !in_array($coord, $places);
    }

    public function render()
    {
        return view('livewire.draws-panel');
    }
}