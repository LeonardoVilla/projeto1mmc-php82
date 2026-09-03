<?php

namespace App\Livewire;

use App\Models\Aluno;
use Livewire\Component;

class AlunoForm extends Component
{
    // Se tiver valor, estamos editando. Se for null, estamos criando.
    public ?int $alunoId = null;
    public string $nome = '';
    public string $email = '';
    public ?string $telefone = '';
    public ?string $data_nascimento = '';

    public function mount(?int $aluno = null): void
    {
        if ($aluno) {
            $registro = Aluno::findOrFail($aluno);

            $this->alunoId = $registro->id;
            $this->nome = $registro->nome;
            $this->email = $registro->email;
            $this->telefone = $registro->telefone;
            $this->data_nascimento = $registro->data_nascimento?->format('Y-m-d');
        }
    }

    public function salvar(): void
    {
        // Campo vazio ("") não é uma data válida, então vira null antes de validar.
        $this->data_nascimento = $this->data_nascimento ?: null;

        $dados = $this->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'nullable',
            'data_nascimento' => 'nullable|date',
        ]);

        Aluno::updateOrCreate(['id' => $this->alunoId], $dados);

        session()->flash('mensagem', $this->alunoId ? 'Aluno atualizado!' : 'Aluno cadastrado!');

        $this->redirect('/alunos', navigate: true);
    }

    public function render()
    {
        return view('livewire.aluno-form');
    }
}
