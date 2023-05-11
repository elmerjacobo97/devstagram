<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    // Relación, [belongsTo] un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    // Un post tiene muchos comentarios (de uno a muchos)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Un post tiene muchos likes (de uno a muchos)
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Revisar si el usuario ya dió like
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
