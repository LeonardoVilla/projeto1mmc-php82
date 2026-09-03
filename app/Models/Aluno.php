<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    // Campos que podem ser preenchidos com create()/update().
    protected $fillable = ['nome', 'email', 'telefone', 'data_nascimento'];

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}
