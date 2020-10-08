<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatList extends Component
{
    public $messages;

    protected $listeners = ["messageReceived"];

    public function mount(){
        $this->messages = [];
    }

    public function messageReceived($message){
        array_push($this->messages, $message);
    }

    public function render()
    {
        return view('livewire.chat-list');
    }

}
