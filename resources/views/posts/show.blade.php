@extends('layouts.app')

@section('title')
    Publicación
@endsection

@section('titlePage')
    {{ $post->titulo }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-6/12 content-center">
            <img width="auto" height="auto" src="{{ asset('uploads' . '/' . $post->imagen) }}"
                alt="Imagen de la publicación {{ $post->titulo }}">

        </div>
        <div class="md:w-6/12">
            <div class="shadow bg-white p-5 mb-5">

                <div class="mb-3">
                    <a href="{{ route('posts.index', $user->username) }}" class="font-bold">{{ $user->username }} -
                        post</a>
                    <p class="text-sm">{{ $post->descripcion }}</p>

                    @auth
                        @if ($post->user_id === auth()->user()->id)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Eliminar"
                                    class="bg-red-500 hover:bg-red-600 p-1 rounded text-white font-bold mt-2 mb-2 cursor-pointer" />
                            </form>
                        @endif
                    @endauth

                </div>

                <div class="mb-3 overflow-y-auto border-b border-t max-h-64 h-64">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-3 border-gray-300 ">
                                <a href="{{ route('posts.index', $comment->user) }}"
                                    class="font-bold">{{ $comment->user->username }}</a>
                                {{ $comment->comentario }}
                                <p class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center p-5">No hay comentarios</p>
                    @endif
                </div>

                <div class=flex items-center gap-4">
                    @auth
                        @if ($post->checkLike(auth()->user()))
                            <form action="{{ route('likes.delete', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="my-1">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('likes.store', $post) }}" method="POST">
                                @csrf
                                <div class="my-1">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        @endif

                    @endauth

                    <p class="ml-2 font-bold">{{ $post->likes->count() }} <span class="font-normal">likes</span></p>
                </div>

                <div class="border-b mt-2">
                    <p class="text-sm text-gray-400 mb-3">{{ $post->created_at->diffForHumans() }}</p>
                    {{-- <p class="mt-5">{{ $post->descripcion }}</p> --}}
                </div>

                @auth
                    {{-- <p class="text-xl gfont-bold text-center mb-4">Agregar un comentario</p> --}}

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg  mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-3 mt-5">
                            <textarea id="comentario" name="comentario" placeholder="Agrega un comentario" rows="1"
                                class=" @error('comentario') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500">{{ old('comentario') }}</textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-500 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-2xl" />
                    </form>
                @endauth

            </div>
        </div>
    </div>
@endsection
