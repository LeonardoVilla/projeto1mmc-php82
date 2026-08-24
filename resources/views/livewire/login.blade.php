<div class="mx-auto mt-20 max-w-sm rounded-lg bg-white p-6 shadow">

    <h1 class="mb-6 text-center text-xl font-semibold">Entrar</h1>

    {{-- wire:submit chama o método entrar() do componente, sem recarregar a página. --}}
    <form wire:submit="entrar" class="space-y-4">

        <div>
            <label class="block text-sm font-medium">E-mail</label>
            {{-- wire:model liga este input à propriedade $email da classe. --}}
            <input type="email" wire:model="email"
                   class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Senha</label>
            <input type="password" wire:model="password"
                   class="mt-1 w-full rounded border border-gray-300 px-3 py-2">
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Entrar
        </button>

    </form>

</div>
