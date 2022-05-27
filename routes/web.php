<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
})->name('home');

/**
 * Rutas registrar un nuevo usuario
 */
Route::get('/register-new-account', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register-new-account', [RegisterController::class, 'store'])->name('user.store');

/**
 * rutas login
 */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

/**
 * Rutas logout
 */
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

/**
 * Rutas de muro
 */
//route model binding, user es un modelo y se quiere usar username del modelo user
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');//route binding
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comments.store');//route binding

Route::post('/images', [ImagenController::class, 'store'])->name('images.store');

Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'delete'])->name('likes.delete');