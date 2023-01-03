@extends('layouts.app');

@section('title')
    Home
@endsection

@section('content')

    <x-list-post :posts="$posts" />


    {{-- <x-list-post>
        <x-slot:title>
            <header>Este es un header</header>
        </x-slot:title>
        <h1>Mostrando post desde slot</h1>
    </x-list-post> --}}
@endsection