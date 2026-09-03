<?php

namespace App\Livewire;

use App\Models\Aluno;
use Livewire\Component;

class Alunos extends Component
{
    public string $busca = '';

    public function excluir(int $id): void
    {
        Aluno::findOrFail($id)->delete();

        session()->flash('mensagem', 'Aluno excluído!');
    }

    public function render()
    {
        $alunos = Aluno::query()
            ->when($this->busca, function ($query) {
                $query->where('nome', 'like', "%{$this->busca}%")
                    ->orWhere('email', 'like', "%{$this->busca}%");
            })
            ->orderBy('nome')
            ->get();

        return view('livewire.alunos', ['alunos' => $alunos]);
    }
}
