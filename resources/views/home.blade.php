@extends('layouts.app')

@section('content')

    <div class="py-4 welcome" style="height: 100vh">
        <div class="py-4 pl-4 pr-4">
            <h3>Chat</h3>
            @livewire('chat-form')
            @livewire('chat-list')
        </div>
    </div>
@endsection
