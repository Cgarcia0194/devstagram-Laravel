<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    {{-- sirve para poder poner hojas de estilo o js importados solo en las partes que se necesiten --}}
    @stack('styles')
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>

<body class="bg-gray-50">
    <header class="p-3 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                DevStagram
            </h1>

            {{-- Cuando no se ha autenticado el usuario --}}
            @auth
                <nav class="flex gap-2 items-center">

                    <a href="{{route('posts.create')}}"
                        class="flex items-center gap-2 bg-white p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>

                    <a class="font-bold text-gray-600" href="{{route('posts.index', auth()->user()->username)}}">
                        Hola <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>
                    |
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600">
                            Cerrar sesión
                        </button>
                    </form>
                </nav>
            @endauth

            {{-- Cuando no se ha autenticado el usuario --}}
            @guest
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600">Login</a>
                    |
                    <a href="{{ route('user.register') }}" class="font-bold uppercase text-gray-600">crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>

    <main class="container mx-auto mt-5 mb-5">
        <h2 class="font-black text-center text-3xl mb-5">
            @yield('titlePage')
        </h2>

        @yield('content')

    </main>

    <footer class="text-center bg-white text-gray-500 font-bold uppercase p-3 bottom-0 left-0 right-0 ">
    {{-- <footer class="text-center bg-white text-gray-500 font-bold uppercase p-3 bottom-0 left-0 right-0 fixed"> --}}
        Devstagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
