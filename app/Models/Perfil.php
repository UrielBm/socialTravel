<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /**
     * Relación reciproca de perfil y usuario 1:1
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
