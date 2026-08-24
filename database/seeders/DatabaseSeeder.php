<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Cria os dados iniciais (php artisan db:seed).
     */
    public function run(): void
    {
        // Usuário para conseguir entrar no sistema.
        User::firstOrCreate(
            ['email' => 'professor@escola.test'],
            [
                'name' => 'Professor',
                'password' => 'senha123',   // o Laravel criptografa sozinho (cast 'hashed')
            ]
        );

        // Alguns alunos de exemplo.
        $alunos = [
            ['nome' => 'Ana Souza',      'email' => 'ana@escola.test',    'telefone' => '11 91111-1111', 'data_nascimento' => '2005-03-14'],
            ['nome' => 'Bruno Lima',     'email' => 'bruno@escola.test',  'telefone' => '11 92222-2222', 'data_nascimento' => '2004-07-02'],
            ['nome' => 'Carla Mendes',   'email' => 'carla@escola.test',  'telefone' => null,            'data_nascimento' => '2006-11-25'],
        ];

        foreach ($alunos as $aluno) {
            Aluno::firstOrCreate(['email' => $aluno['email']], $aluno);
        }
    }
}
