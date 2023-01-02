@extends('layouts.app');

@section('title')
    Home
@endsection

@section('content')
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    {{-- $post es como tal el post, laravel se encarga de mapearlo --}}
                    <a href="{{ route('posts.show', [ 'post' => $post, 'user' => $post->user ]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p>No hay posts</p>
    @endif

    {{-- @forelse ($posts as $post )
        <h1>{{ $post->title }}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}

@endsection