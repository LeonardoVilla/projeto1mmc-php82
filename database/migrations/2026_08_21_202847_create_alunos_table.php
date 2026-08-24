<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de alunos.
     */
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();                                   // chave primária automática
            $table->string('nome');                         // obrigatório
            $table->string('email')->unique();              // não pode repetir
            $table->string('telefone')->nullable();         // opcional
            $table->date('data_nascimento')->nullable();    // opcional
            $table->timestamps();                           // created_at e updated_at
        });
    }

    /**
     * Desfaz a migration (php artisan migrate:rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
