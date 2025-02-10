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
    public $showDrawButton = true;
    public $showDraw = false;

    public function mount()
    {
        $this->actualYear = now()->year;
        $this->loadGrid();
    }

    // Cargar la cuadrícula con las ubicaciones existentes
    public function loadGrid()
    {
        // Inicializar la cuadrícula vacía
        $this->grid = array_fill(0, $this->MAX_HEIGHT, array_fill(0, $this->MAX_WIDTH, null));
    
        // Obtener las ubicaciones para el año actual con la relación "crews"
        $locations = Location::where('year', $this->actualYear)->with('crew')->get();
        
        // Si hay ubicaciones, deshabilitar el botón de sorteo
        if ($locations->count() > 0) {
            $this->showDrawButton = false;
        }

        // Si no hay ubicaciones, no se muestra nada
        if ($locations->count() < 0) {
            $this->showDraw = true;
        }
    
        // Llenar la cuadrícula con las ubicaciones existentes
        foreach ($locations as $location) {
            if ($location->crew && $location->crew->isNotEmpty()) {
                $this->grid[$location->y][$location->x] = $location->crew->first()->name;
            }
        }
    }
    
    public function draw()
    {
        // Obtener todas las peñas
        $crews = Crew::all();
    
        // Verificar si hay peñas disponibles
        if ($crews->count() === 0) {
            session()->flash('error', 'No hay peñas disponibles para realizar el sorteo.');
            return;
        }
    
        // Generar coordenadas aleatorias únicas para cada peña
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
            // Crear la ubicación
            $location = Location::create([
                'x' => $coord[0],
                'y' => $coord[1],
                'year' => $this->actualYear,
            ]);
    
            // Relacionar la ubicación con la peña en la tabla draws
            $location->crew()->attach($crewId);
        }
    
        // Recargar la cuadrícula
        $this->loadGrid();
        $this->showDrawButton = false;
        $this->showDraw = true;
        session()->flash('success', 'Sorteo realizado correctamente.');
    }

    public function resetThisYearCrews(){
        $locations = Location::where('year', $this->actualYear)->get();

        foreach ($locations as $location) {
            $location->crew()->detach();
            $location->delete();
        }
    
        // Recargar la cuadrícula
        $this->loadGrid();
        $this->showDrawButton = true;
        session()->flash('success', 'Sorteo reiniciado correctamente.');
    }

    // Validar si una coordenada ya está ocupada
    private function validCoords($coord, $places)
    {
        return !in_array($coord, $places);
    }

    public function render()
    {
        return view('livewire.draws-panel');
    }
}