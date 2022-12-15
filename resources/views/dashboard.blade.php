@extends('layouts.app')

@section('title')
    Tu cuenta
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                {{-- El cambio de auth() a solo $user->username nos permite hacer dinamica la interaccion del username en la url --}}
                <p class="text-gray-700 text-2xl">{{$user->username }}</p>
            </div>
        </div>
    </div>
@endsection