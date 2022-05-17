<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url_video',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // EVento que se ejecuta cuando el usuario es creado
    protected static function boot()
    {
        parent::boot();

        //asignar un perfil al usuario cuando se cree

        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    /**
     * Relación de uno a muchos de usuario a viajes
     */

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
    /**
     * Relación 1:1 de usuario y perfil
     */
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //Recetas que el usuario le ha dado me gusta
    public function meGusta()
    {
        return $this->belongsToMany(Viaje::class, "likes_viaje");
    }
}
