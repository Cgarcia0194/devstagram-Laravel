@extends('layouts.app')

@section('title')
    Nueva publicación
@endsection

@section('titlePage')
    Registra una nueva publicación
@endsection

{{-- dependel del stack que está en app.blade.php para cargar solo los estilos y/o JS que requiere cada archivo --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-2/4 px-10">
            <form id="dropzone" action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data"
                class="dropzone @error('imagen') border-red-500 @enderror border-dotted border-4 w-full h-72 rounded-xl flex flex-col justify-center items-center">
                @csrf
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <div class="md:w-2/4 bg-white p-10 rounded-md shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <input type="text" id="titulo" name="titulo" placeholder="Título de la publicación"
                        value="{{ old('titulo') }}"
                        class=" @error('titulo') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación" rows="3"
                        class=" @error('descripcion') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" id="imagen" value="{{ old('imagen') }}" />
                </div>

                <input type="submit" value="Crear"
                    class="bg-sky-500 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-2xl" />
            </form>
        </div>
    </div>
@endsection
