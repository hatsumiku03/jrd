<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\HomeFormMail;

class HomeForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Enviar el correo
        Mail::to('mrbabu@babu.local')->send(new HomeFormMail($this->name, $this->email, $this->message));

        // Limpiar el formulario
        $this->reset(['name', 'email', 'message']);

        // Mostrar un mensaje de éxito
        session()->flash('message', '¡Gracias por contactarnos!');
    }
    public function render()
    {
        return view('livewire.home-form');
    }
}
