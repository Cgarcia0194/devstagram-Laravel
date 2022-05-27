<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back(); //regresa a donde está haciendose la petición
    }

    public function delete(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back(); //regresa a donde está haciendose la petición
    }
}
