<div class="mx-auto max-w-lg">

    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-lg font-semibold">{{ $alunoId ? 'Editar aluno' : 'Novo aluno' }}</h1>
        <a href="/alunos" wire:navigate class="text-sm text-blue-600">&larr; Voltar para a lista</a>
    </div>

    <div class="bg-white p-4">
        <form wire:submit="salvar" class="space-y-4">

            <div>
                <label>Nome</label>
                <input type="text" wire:model="nome" class="input">
                @error('nome') <span class="erro">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>E-mail</label>
                <input type="email" wire:model="email" class="input">
                @error('email') <span class="erro">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Telefone</label>
                <input type="text" wire:model="telefone" class="input">
                @error('telefone') <span class="erro">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Data de nascimento</label>
                <input type="date" wire:model="data_nascimento" class="input">
                @error('data_nascimento') <span class="erro">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-green">Salvar</button>
                <a href="/alunos" wire:navigate class="btn btn-gray">Cancelar</a>
            </div>

        </form>
    </div>

</div>
