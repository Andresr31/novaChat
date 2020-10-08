<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatForm extends Component
{
    public $name;
    public $message;

    public function mount(){
        $this->name = "";
        $this->message = "";
    }

    public function render()
    {
        return view('livewire.chat-form');
    }

    public function updated($field){
        $this->validateOnly($field,[
            "name"=>"required|min: 3",
            "message"=>"required"
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            "name"=>"required|min: 3",
            "message"=>"required"
        ]);

        $this->emit("messageSent");

        $datos = [
            'user'=>$this->name,
            'message'=>$this->message,
        ];
        $this->emit("messageReceived",$datos);
    }



}
