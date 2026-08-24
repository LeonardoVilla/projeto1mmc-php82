<?php

namespace App\Livewire;

use App\Models\Aluno;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Alunos extends Component
{
    // Campo da caixa de busca.
    public string $busca = '';

    // Controla se o formulário está aparecendo na tela.
    public bool $mostrandoFormulario = false;

    // Guarda o id quando estamos EDITANDO. Se for null, estamos CRIANDO.
    public ?int $alunoId = null;

    // Campos do formulário.
    public string $nome = '';

    public string $email = '';

    public ?string $telefone = '';

    public ?string $data_nascimento = '';

    /**
     * Botão "Novo aluno": limpa o formulário e mostra ele.
     */
    public function novo(): void
    {
        $this->limparFormulario();
        $this->mostrandoFormulario = true;
    }

    /**
     * Botão "Editar": carrega os dados do aluno no formulário.
     */
    public function editar(int $id): void
    {
        $aluno = Aluno::findOrFail($id);

        $this->alunoId = $aluno->id;
        $this->nome = $aluno->nome;
        $this->email = $aluno->email;
        $this->telefone = $aluno->telefone;
        $this->data_nascimento = $aluno->data_nascimento?->format('Y-m-d');

        $this->mostrandoFormulario = true;
    }

    /**
     * Botão "Salvar": vale tanto para criar quanto para atualizar.
     */
    public function salvar(): void
    {
        // Campos opcionais vazios viram null antes de validar.
        $this->telefone = $this->telefone ?: null;
        $this->data_nascimento = $this->data_nascimento ?: null;

        $dados = $this->validate([
            'nome' => 'required|string|min:3|max:255',
            // Ao editar, ignora o próprio aluno na checagem de e-mail repetido.
            'email' => ['required', 'email', Rule::unique('alunos')->ignore($this->alunoId)],
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
        ], [
            // Mensagens de erro em português.
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome precisa ter pelo menos 3 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'data_nascimento.date' => 'Informe uma data válida.',
        ]);

        // Se alunoId for null, cria um novo. Se tiver valor, atualiza aquele aluno.
        Aluno::updateOrCreate(['id' => $this->alunoId], $dados);

        session()->flash('mensagem', $this->alunoId ? 'Aluno atualizado!' : 'Aluno cadastrado!');

        $this->limparFormulario();
        $this->mostrandoFormulario = false;
    }

    /**
     * Botão "Excluir".
     */
    public function excluir(int $id): void
    {
        Aluno::findOrFail($id)->delete();

        session()->flash('mensagem', 'Aluno excluído!');
    }

    /**
     * Botão "Cancelar".
     */
    public function cancelar(): void
    {
        $this->limparFormulario();
        $this->mostrandoFormulario = false;
    }

    private function limparFormulario(): void
    {
        $this->reset(['alunoId', 'nome', 'email', 'telefone', 'data_nascimento']);
        $this->resetValidation();
    }

    /**
     * Roda a cada interação e devolve a tela atualizada.
     */
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
