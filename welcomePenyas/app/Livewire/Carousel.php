<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $images;
    public $quotes;

    public $currentImage = 0;

    protected $listeners = ['nextImage', 'previousImage'];

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
            'SOCORRO, BABU ME ESTA SECUESTRANDO',
            'Ese papu misterioso',
            
        ];
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
