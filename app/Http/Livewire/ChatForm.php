<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatForm extends Component
{
    public $user;
    public $message;

    // Generar datos para pruebas
    private $faker;

    // Mantenemos estos valores actualizados en
    // la barra de direcciones...
    // Ej.: https://your-app.com/?usuario=Pedro
    protected $updatesQueryString = ['user'];

    // Eventos Recibidos
    protected $listeners = ['requestUser'];

    public function mount(){
        // Instanciamos Faker
        $this->faker = \Faker\Factory::create();

        // Obtenemos el valor de usuario de la barra de direcciones
        // si no existe, generamos uno con Faker
        $this->user = request()->query('user', $this->user) ?? $this->faker->name;

        // Generamos el primer texto de prueba
        $this->message = $this->faker->realtext(20);
    }

    // Cuando el otro componente nos solicitan el usuario
    public function requestUser()
    {
        // Lo emitimos por evento
        $this->emit('changeUser', $this->user);
    }

    // Cuando actualizamos el nombre de usuario
    public function updatedUser()
    {
        // Notificamos al otro componente el cambio
        $this->emit('changeUser', $this->user);
    }

    // Se produce cuando se actualiza cualquier dato por Binding
    public function updated($field)
    {
        // Solo validamos el campo que genera el update
        $validatedData = $this->validateOnly($field, [
            'user' => 'required',
            'message' => 'required',
        ]);
    }


    public function sendMessage()
    {


        $validatedData = $this->validate([
            'user' => 'required',
            'message' => 'required',
        ]);

        // Guardamos el mensaje en la BBDD
        \App\Chat::create([
            "user" => $this->user,
            "message" => $this->message
        ]);

        // Generamos el evento para Pusher
        // Enviamos en la "push" el usuario y mensaje (aunque en este ejemplo no lo utilizamos)
        // pero nos vale para comprobar en PusherDebug (y por consola) lo que llega...
        event(new \App\Events\SendMessage($this->user,$this->message));

        // Este evento es para que lo reciba el componente
        // por Javascript y muestre el ALERT BOOTSRAP de "enviado"
        $this->emit('sendOk', $this->message);

        // Creamos un nuevo texto aleatorio (para el próximo mensaje)
        $this->faker = \Faker\Factory::create();
        $this->message = $this->faker->realtext(20);
    }

    public function render()
    {
        return view('livewire.chat-form');
    }



}
