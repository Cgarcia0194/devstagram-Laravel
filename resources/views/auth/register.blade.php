@extends('layouts.app')

@section('title')
    Registrate en Devstagram
@endsection

@section('titlePage')
    Registrate en Devstagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10">

        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro">
        </div>

        <div class="md:w-4/12 bg-white p-4 rounded-md shadow-xl">
            <form action="{{ route('user.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <input type="text" id="name" name="name" placeholder="Nombre(s)" value="{{ old('name') }}"
                        class=" @error('name') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="text" id="username" name="username" placeholder="Nombre de usuario"
                        value="{{ old('username') }}"
                        class=" @error('username') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="email" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}"
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
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirma tú contraseña" value="{{ old('password_confirmation') }}"
                        class=" @error('password_confirmation') border-red-500 @enderror border p-3 w-full rounded-2xl focus:outline-none focus:border-sky-500" />
                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Crear cuenta"
                    class="bg-sky-500 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-2xl">
            </form>
        </div>
    </div>
@endsection
