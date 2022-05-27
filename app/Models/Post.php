<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comments()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Función que revisa si un usuario ya dio like a una publicación
     */
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
