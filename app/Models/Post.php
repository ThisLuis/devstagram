<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Esta informacion es la que se va a llenar en la base de datos
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    // Relacion: Un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo((User::class))->select(['name', 'username']);
    }

    // Debemos de nombrar el metodo user, de lo contrario si queremos nombrarlo author o con cualquier otro nombre, debemos de especificar el campo que funcionara como id, en este caso es user_id
    // public function author()
    // {
    //     return $this->belongsTo((User::class, 'user_id'))->select(['name', 'username']);
    // }
}
