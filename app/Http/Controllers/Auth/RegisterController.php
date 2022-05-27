<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        //validación
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'username' => 'required|min:3|max:50|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6|confirmed' //confirmed sirve para confirmar con el campo password_confirmed
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) //se hashea el paswword
        ]);

        //helper que ayuda a autenticar
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
