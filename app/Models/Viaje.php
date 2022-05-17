<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'titulo',
        'topic_places',
        'description',
        'picture',
        'cost',
        'days',
        'categoria_id'
    ];

    //recuperando categoria de los viajes mediante FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaViaje::class, "categoria_id");
    }

    //recuperando info del usuario mediante FK
    public function autor()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    // likes que tiene el viaje.
    public function likes()
    {
        return $this->belongsToMany(User::class, "likes_viaje");
    }
}
