<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Las relaciones son metodos que existen en los modelos
    // Crear relacion

    public function posts()
    {
        // relacion one to many - un usuario puede tener multiples posts
        // hasManu recibe como parametro el nombre del modelo con el que haremos la relacion
        return $this->hasMany(Post::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Almacenar los seguidores de un usuario
    public function followers()
    {   
        // Table: followers -> Fields: user_id y follower_id
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
        
    }
}
