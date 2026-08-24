<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

// Diz ao Eloquent quais campos podem ser preenchidos em massa (create/update).
#[Fillable(['nome', 'email', 'telefone', 'data_nascimento'])]
class Aluno extends Model
{
    /**
     * Converte a coluna data_nascimento para um objeto de data
     * automaticamente ao ler do banco.
     */
    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
        ];
    }
}
