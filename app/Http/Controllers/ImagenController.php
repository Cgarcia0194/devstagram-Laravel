<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //se obtiene del request el archivo
        $file = $request->file('file');

        //se genera un nombre único con uuid para que no se repita
        $imageName = Str::uuid() . "." . $file->extension();

        //clase de intervention image para crear una imagen
        $imageServer = Image::make($file);
        $imageServer->fit(1000, 1000); //efecto de intervention image

        $imagePath = public_path('uploads') . "/" . $imageName;

        $imageServer->save($imagePath);//se guarda la imagen en la carpeta uploads

        return response()->json(['imagen' => $imageName]);
    }
}
