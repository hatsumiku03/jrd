<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $images;

    // ! This arrays isn't automatized
    // ! We need to add a function for select random quotes, and vía quotes, the crew name
    public $quotes;
    public $crewsName;

    public $currentImage = 0;

    protected $listeners = ['nextImage', 'previousImage'];

    // ! He dejado estas funciones inútiles porque en el carousel estoy usando alpine para no llamar al servidor
    // ! todo el rato con wire:click, he de mirar de arreglarlo, había una opción de livewire para no estar haciendo request constantemente al server
    public function nextImage(){
        $this->currentImage = ($this->currentImage + 1) % count($this->images);
    }

    public function previousImage(){
        $this->currentImage = ($this->currentImage - 1 + count($this->images)) % count($this->images); 
    }
    public function mount()
    {
        $this->images = [
            asset('images/Carousel/image1.jpg'),
            asset('images/Carousel/image2.jpg'),
            asset('images/Carousel/image3.jpg'),
        ];
        $this->quotes = [
            'Señorets, viva les penyes',
            'Nos arrodillaremos ante el general tablos',
            'ANEM A GUANYAR',
            
        ];

        $this->crewsName = [
            'Los Babus',
            'E S E N C I A',
            'Els xics',
            
        ];
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
