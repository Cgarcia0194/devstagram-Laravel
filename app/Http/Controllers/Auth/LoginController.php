<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user() === null) {
            return view('auth.login');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required' //confirmed sirve para confirmar con el campo password_confirmed
        ]);

        if (auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('posts.index', auth()->user()->username);
        }

        //with sirve para llenar un valor creado manualmente y pasarlo a la vista
        //back regresa a la página donde se envío la petición
        return back()->with('mensaje', 'Credenciales incorrectas');
    }
}
