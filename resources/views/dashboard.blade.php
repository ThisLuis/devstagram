@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                
                <div class="flex item-center gap-3">
                    {{-- El cambio de auth() a solo $user->username nos permite hacer dinamica la interaccion del username en la url --}}
                    <p class="text-gray-700 text-2xl">{{$user->username }}</p>

                    @auth
                        @if($user->id === auth()->user()->id)
                            <a 
                                href="{{ route('perfil.index') }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>  
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguido|Seguidos', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Post</span>
                </p>

                @auth
                {{-- Comprobamos que el id del usuario que viene de request sea distinto al que esta autenticado --}}
                    @if($user->id !== auth()->user()->id)
                    {{-- $user es la persona que estamos visitando su perfil --}}
                    {{-- auth()->user: Es la persona que lo esta visitando --}}
                        @if(!$user->following(auth()->user()))
                            
                            {{-- User es el usuario a seguir, no el autenticado --}}
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input 
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Follow"
                                />

                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input 
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Unfollow"
                                />

                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>
       <x-list-post :posts="$posts"/>
    </section>
@endsection