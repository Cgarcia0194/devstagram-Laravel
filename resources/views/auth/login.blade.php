@extends('layouts.app')

@section('title')
    Login
@endsection

@section('titlePage')
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10">

        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login al sistema">
        </div>

        <div class="md:w-4/12 bg-white p-4 rounded-md shadow-xl">
            <h1 class="text-3xl text-center p-2 mb-4">Iniciar sesión</h1>

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <input type="email" id="email" name="email" placeholder="Correo electrónico"
                        value="{{ old('email') }}"
                        class=" @error('email') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="password" id="password" name="password" placeholder="Contraseña"
                        value="{{ old('password') }}"
                        class=" @error('password') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember" class="valid:border-green-500">
                    <label for="remember" class="text-gray-800 text-sm">Mantener mi sesión activa</label>
                </div>

                <input type="submit" value="Iniciar sesión"
                    class="bg-sky-500 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-2xl">
            </form>
        </div>
    </div>
@endsection
