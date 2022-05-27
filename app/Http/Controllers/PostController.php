<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        //es un middleware de laravel que se ejecuta en el constructor para verificar que esté autenticado
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        // $posts = Post::where('user', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->paginate(10);
        // $posts = Post::where('user', $user->id)->simplepaginate(2);

        //retorna la ista dashboard, los posts que ha publicado el usuario
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //forma usando model y el fillable y en una instancia lo hace todo
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //otra forma creando una instancia
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user = auth()->user()->id;

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //eliminar imagen
        $imagePath = public_path('uploads/' . $post->imagen);

        if(File::exists($imagePath)){
            unlink($imagePath);
            // File::delete(); en algunos funciona y en otros no
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
