<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Obtenemos el file del request
        $image = $request->file('file');
        // Genera un id unico para cada una de las imagenes, en nuestro server no puede haber dos archivos que se llamen igual
        $nameImage = Str::uuid() . "." . $image->extension();

        // Esto permite crear una imagen de intervention image
        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        // Creamos el path de la imagen
        $imagePath = public_path('uploads'). '/' . $nameImage;

        // Guardamos la imagen en el servidor, como parametro pasamos el path de donde se va a guardar
        $imageServer->save($imagePath);
        return response()->json(['image'=>$nameImage]);
    }
}
