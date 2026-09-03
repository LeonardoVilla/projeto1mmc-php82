<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    // Cada propriedade pública vira um campo do formulário na tela.
    public string $email = '';

    public string $password = '';

    /**
     * Executado quando o formulário de login é enviado.
     */
    public function entrar()
    {
        // 1. Valida o que o usuário digitou.
        $credenciais = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Tenta autenticar. Auth::attempt confere o e-mail e a senha no banco.
        if (! Auth::attempt($credenciais)) {
            $this->addError('email', 'E-mail ou senha inválidos.');

            return;
        }

        // 3. Gera um novo ID de sessão (proteção contra roubo de sessão).
        session()->regenerate();

        // 4. Manda o usuário para a listagem de alunos.
        return $this->redirect('/alunos', navigate: true);
    }

    public function render()
    {
        return view('livewire.login');
    }
}
