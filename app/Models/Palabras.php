<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Palabras extends Model
{
    use HasFactory;

    protected $fillable = [
        'ortografia',
        'traduccion',
        'audio',
        'capitulo_id',
        'observacion',
    ];
}
