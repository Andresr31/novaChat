<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatList extends Component
{
    public $user;
    protected $lastId;
    public $messages;

    protected $listeners = ['messageReceived', 'changeUser'];

    public function mount(){
        $this->lastId = 0;
        $this->messages = [];
        $this->user = request()->query('user', $this->user) ?? "";
    }

    public function messageReceived($data){
        $this->updateMessage($data);
    }

    public function changeUser($user)
    {
        $this->user = $user;
    }

    public function updateMessage($data)
    {
        if($this->user != "")
        {
            // El contenido
            //$data = \json_decode(\json_encode($data));

            $messages = \App\Chat::orderBy("created_at", "desc")->take(5)->get();
            //$this->messages = [];

            foreach($messages as $message)
            {
                if($this->lastId < $message->id)
                {
                    $this->lastId = $message->id;

                    $item = [
                        "id" => $message->id,
                        "user" => $message->user,
                        "message" => $message->message,
                        "received" => ($message->user != $this->user),
                        "date" => $message->created_at->diffForHumans()
                    ];

                    array_unshift($this->messages, $item);
                    //array_push($this->mensajes, $item);
                }

            }

            if(count($this->messages) > 5)
            {
                array_pop($this->messages);
            }
        }
        else
        {
            $this->emit('requestUser');
        }
    }

    public function resetMessages()
    {
        $this->messages = [];
        $this->updateMessage([]);
    }

    public function dydrate()
    {
        if($this->usuario == "")
        {
            // Le pedimos el uisuario al otro componente
            $this->emit('solicitaUsuario');
        }
    }

    public function render()
    {
        return view('livewire.chat-list');
    }

}
