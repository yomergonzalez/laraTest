<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    Protected $fillable = ['publication_id', 'content', 'user_id'];

    protected $attributes = [
        'status' => 'APROBADO',
    ];

    /**
     * Get the publication.
     * DESAFIO 2, Relacion uno a muchos a uno.
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
