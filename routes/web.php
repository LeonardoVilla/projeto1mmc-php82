<?php

use App\Livewire\Alunos;
use App\Livewire\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página inicial: manda para a listagem de alunos.
Route::get('/', fn () => redirect('/alunos'));

// Tela de login. O middleware 'guest' impede que quem já está logado veja de novo.
Route::get('/login', Login::class)->name('login')->middleware('guest');

// Tudo aqui dentro exige estar autenticado.
Route::middleware('auth')->group(function () {

    // Um componente Livewire pode virar uma página inteira.
    Route::get('/alunos', Alunos::class)->name('alunos');

    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    })->name('logout');

});
