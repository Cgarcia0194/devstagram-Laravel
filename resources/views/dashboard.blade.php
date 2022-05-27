@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('titlePage')
    Perfil {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-12/12 flex flex-col items-center md:flex-row lg:flex-row">
            <div class="md:w-4/12 lg:w-2/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen usuario">
            </div>
            <div class="md:w-4/12 lg:w-4/12 px-5 flex flex-row items-center md:justify-center md:items-start py-10">
                <p class="text-gray-800 text-sm mb-3 mr-3 font-bold">
                    {{ $posts->count() }}
                    <span class="font-normal">Publicaciones</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 mr-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 mr-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
            </div>
            <div class="md:w-4/12 lg:w-4/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <p class="text-gray-900 text-2xl font-medium">{{ $user->name }}</p>
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="{{ route('posts.create') }}"
                            class="flex items-center gap-2 bg-white border p-2 mt-2 text-gray-600 rounded text-sm font-bold cursor-pointer">
                            Editar perfil
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-5">
            Publicaciones
        </h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="">
                        {{-- pasando $post laravel mapea el objeto y toma a id y lo manda en la variable que espera
                            la ruta (esta variable puede llamarse como sea)
                            Se pasan dos valores:
                            por eso se pasa por un arreglo asignando un nombre al arreglo --}}
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}"
                                alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="my-10">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 font-bold text-center text-lg mb-5 mt-5 uppercase">No hay publicaciones</p>
        @endif

    </section>
@endsection
