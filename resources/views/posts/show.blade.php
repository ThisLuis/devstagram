@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image}}" alt="{{ $post->title }}">

            <div class="p-3 flex items-center gap-4">
                @auth()

                {{-- @php
                    $message = "Hola mundo desde una variable";
                @endphp --}}

                    
                    {{-- Cuando mandamos llamar este livewire, se ejecuta automaticamente la function mount() --}}
                    <livewire:like-post :post="$post"/>


                   
                @endauth
               
            </div>

            <div>
                {{-- user es el metodo(la relacion que creamos en PostController belongsTo) --}}
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHUmans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            {{-- Verificamos que este autenticado --}}
            @auth
                {{-- Comprobamos que el user_id sea igual al id del user --}}
                @if($post->user_id === auth()->user()->id)
                    {{-- El navegador soporta unicamente g/p ms te permite otro tipo de peticiones como pueden ser put/patch o delete --}}
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('delete')
                        @csrf
                        <input 
                            type="submit"
                            value="Elimiar Post"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        />
                    </form>
                @endif
            @endauth
           

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth
                <p class="text-xl font-bold text-center mb-4">Agregar un nuevo comentario</p>

                @if(session('message'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('commentaries.store', ['post'=> $post, 'user' => $user ]) }}" >
                    @csrf
                    <div class="mb-5">
                        <label for="commentary" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comment
                        </label>
                        <textarea 
                            name="commentary" 
                            id="commentary" 
                            placeholder="Type commentary"
                            class="border p-3 w-full rounded-lg @error('commentary') border-red-500 @enderror"
                        >
                            
                        </textarea>
                        @error('commentary')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input 
                        type="submit"
                        value="Comment"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
                </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->commentaries->count())
                        @foreach ($post->commentaries as $commentary)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $commentary->user) }}" class="font-bold">
                                    {{ $commentary->user->username }}
                                </a>
                                <p>{{ $commentary->commentary }}</p>
                                <p class="text-sm text-gray-500">{{ $commentary->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay comentarios aun</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection