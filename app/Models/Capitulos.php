<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Capitulos extends Model
{
    use HasFactory;

    protected $fillable = [
        'leccion',
        'name'
    ];
}
