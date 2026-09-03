<div>

    @if (session('mensagem'))
        <div class="mb-4 bg-green-100 p-2 text-green-800">
            {{ session('mensagem') }}
        </div>
    @endif

    <div class="mb-4 flex gap-3">
        {{-- .live faz a busca acontecer enquanto o usuário digita. --}}
        <input type="text" wire:model.live="busca" placeholder="Buscar por nome ou e-mail..." class="input flex-1">

        <a href="/alunos/novo" wire:navigate class="btn btn-blue">+ Novo aluno</a>
    </div>

    <table class="w-full bg-white text-left text-sm">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="p-3">Nome</th>
                <th class="p-3">E-mail</th>
                <th class="p-3">Telefone</th>
                <th class="p-3">Nascimento</th>
                <th class="p-3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alunos as $aluno)
                <tr class="border-b">
                    <td class="p-3">{{ $aluno->nome }}</td>
                    <td class="p-3">{{ $aluno->email }}</td>
                    <td class="p-3">{{ $aluno->telefone ?: '-' }}</td>
                    <td class="p-3">{{ $aluno->data_nascimento?->format('d/m/Y') ?: '-' }}</td>
                    <td class="p-3">
                        <a href="/alunos/{{ $aluno->id }}/editar" wire:navigate class="text-blue-600">Editar</a>

                        {{-- wire:confirm mostra a caixa "tem certeza?" do navegador. --}}
                        <button wire:click="excluir({{ $aluno->id }})"
                                wire:confirm="Tem certeza que deseja excluir este aluno?"
                                class="ml-3 text-red-600">
                            Excluir
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Nenhum aluno encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
