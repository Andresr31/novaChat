@extends('layouts.app')

@section('content')

    <div class="py-4 welcome" style="height: 100vh">
        <div class=" align-content-center text-center pl-4 pr-4">
            <a class="btn btn-outline-dark col-md-12 btn-block " href="{{route("chat")}}">Ingresar al chat</a>
        </div>
    </div>
@endsection
