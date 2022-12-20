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
}
