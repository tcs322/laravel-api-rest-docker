<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'usuario';

    protected $fillable = [
        'nome',
        'email',
        'password'
    ];
}
