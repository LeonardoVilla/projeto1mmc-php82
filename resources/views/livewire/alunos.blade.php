<div>

    {{-- Mensagem de sucesso (definida com session()->flash no componente). --}}
    @if (session('mensagem'))
        <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">
            {{ session('mensagem') }}
        </div>
    @endif

    <div class="mb-4 flex items-center gap-3">
        {{-- .live faz a busca acontecer enquanto o usuário digita. --}}
        <input type="text" wire:model.live="busca" placeholder="Buscar por nome ou e-mail..."
               class="flex-1 rounded border border-gray-300 px-3 py-2">

        <button wire:click="novo"
                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            + Novo aluno
        </button>
    </div>

    {{-- ===== FORMULÁRIO (aparece só quando $mostrandoFormulario é true) ===== --}}
    @if ($mostrandoFormulario)
        <div class="mb-6 rounded-lg bg-white p-4 shadow">

            <h2 class="mb-4 font-semibold">
                {{ $alunoId ? 'Editando aluno' : 'Novo aluno' }}
            </h2>

            <form wire:submit="salvar" class="space-y-4">

                <div>
                    <label class="block text-sm font-medium">Nome</label>
                    <input type="text" wire:model="nome"
                           class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
                    @error('nome') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">E-mail</label>
                    <input type="email" wire:model="email"
                           class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Telefone</label>
                    <input type="text" wire:model="telefone"
                           class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
                    @error('telefone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Data de nascimento</label>
                    <input type="date" wire:model="data_nascimento"
                           class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
                    @error('data_nascimento') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                        Salvar
                    </button>
                    <button type="button" wire:click="cancelar"
                            class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
                        Cancelar
                    </button>
                </div>

            </form>

        </div>
    @endif

    {{-- ===== LISTAGEM ===== --}}
    <div class="overflow-x-auto rounded-lg bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="border-b bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">E-mail</th>
                    <th class="px-4 py-3">Telefone</th>
                    <th class="px-4 py-3">Nascimento</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alunos as $aluno)
                    <tr class="border-b last:border-0">
                        <td class="px-4 py-3">{{ $aluno->nome }}</td>
                        <td class="px-4 py-3">{{ $aluno->email }}</td>
                        <td class="px-4 py-3">{{ $aluno->telefone ?: '-' }}</td>
                        <td class="px-4 py-3">
                            {{ $aluno->data_nascimento?->format('d/m/Y') ?: '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <button wire:click="editar({{ $aluno->id }})"
                                    class="text-blue-600 hover:underline">
                                Editar
                            </button>

                            {{-- wire:confirm mostra a caixa "tem certeza?" do navegador. --}}
                            <button wire:click="excluir({{ $aluno->id }})"
                                    wire:confirm="Tem certeza que deseja excluir este aluno?"
                                    class="ml-3 text-red-600 hover:underline">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Nenhum aluno encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
