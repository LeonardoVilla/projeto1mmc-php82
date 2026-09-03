<div class="mx-auto mt-20 max-w-sm bg-white p-6">

    <h1 class="mb-6 text-center text-xl font-semibold">Entrar</h1>

    {{-- wire:submit chama o método entrar() do componente, sem recarregar a página. --}}
    <form wire:submit="entrar" class="space-y-4">

        <div>
            <label>E-mail</label>
            {{-- wire:model liga este input à propriedade $email da classe. --}}
            <input type="email" wire:model="email" class="input">
            @error('email') <span class="erro">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Senha</label>
            <input type="password" wire:model="password" class="input">
            @error('password') <span class="erro">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-blue w-full">Entrar</button>

    </form>

</div>
