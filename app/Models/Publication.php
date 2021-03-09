<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    Protected $fillable = ['title', 'content', 'user_id',];

    /**
     * Get the comments.
     * DESAFIO 2, Relacion uno a muchos
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
