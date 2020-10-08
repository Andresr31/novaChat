<div>
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" class="form-control" id="name" wire:model="name">
        @error('name')
            <small class="text-danger h6" >{{$message}}</small >
        @enderror
    </div>

    <div class="form-group">
        <label for="message">Mensaje:</label>
        <input type="text" class="form-control" id="message" wire:model="message">
        @error('message')
            <small class="text-danger h6" >{{$message}}</small >
        @enderror
    </div>

    <div class="form-group">
        <button class="btn btn-dark" wire:click="sendMessage">Enviar Mensaje</button>
    </div>

    {{-- Mensaje de alerta --}}
    <div style="position: absolute; my-4" class="alert alert-success collapse" role="alert" id="alert">
        Mensaje enviado
    </div>


    {{-- Recibir notificación --}}
    <script>
        window.livewire.on('messageSent',function(){
            //Mostrar aviso
            $('#alert').fadeIn("slow");

            //Ocultar aviso a los 3 segundos
            setTimeout(function(){$('#alert').fadeOut("slow");},3000);

        });
    </script>


</div>


