<?php

namespace App\Livewire;

use Livewire\Component;

class DrawsPanel extends Component
{
    public $MAX_WIDTH = 10;
    public $MAX_HEIGHT = 10;

    public function draw(){
        return redirect()->route('management');
    }
    public function render()
    {
        return view('livewire.draws-panel');
    }
}

// Método para la lógica del sorteo
// Método para verificar que la coordenada sea válida