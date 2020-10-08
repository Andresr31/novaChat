<div>
    <h3 class="mt-4"> Lista de mensajes </h3>
    <ul>
        @foreach ($messages as $message)
            <li>- {{$message['user']}}: {{$message['message']}}</li>
        @endforeach
    </ul>


    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('05f23660c3178a8d9954', {
          cluster: 'us2'
        });

        var channel = pusher.subscribe('chat-channel');
        channel.bind('chat-event', function(data) {
          alert(JSON.stringify(data));
        });

    </script>
</div>
