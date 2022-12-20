@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

@section('title')
    Create new post
@endsection



@section('content')
    {{-- ALERTA --}}
    <div class="alert-success flex self-center md:w-4/12 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Upload Image</strong>
        <span class="block sm:inline">successfully, great</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
    </div>

    <div class="md:flex md:items-center">
        
        <div class="md:w-1/2 px-10">
            {{-- Para subir la imagen a dropzone --}}
            <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" action="">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="title">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="Title"
                        class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}"
                    >
                    {{-- En 'name' va el nombre del campo que vamos a validar --}}
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="description">Describe</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Type description"
                        class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    {{-- En 'name' va el nombre del campo que vamos a validar --}}
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        name="image"
                        type="hidden"
                        value="{{ old('image') }}"
                    />
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Publish"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection
