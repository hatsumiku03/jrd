<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\HomeFormMail;

class HomeForm extends Component
{
    public $name;
    public $email;
    public $content;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'content' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        // Enviar el correo
        Mail::to('mrbabu@babu.local')->send(new HomeFormMail($this->name, $this->email, $this->content));

        // Limpiar el formulario
        $this->reset(['name', 'email', 'content']);

        // Mostrar un mensaje de éxito
        session()->flash('message', '¡Gracias por contactarnos!');
    }
    public function render()
    {
        return view('livewire.home-form');
    }
}
