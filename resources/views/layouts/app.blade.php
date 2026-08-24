<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Cadastro de Alunos' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 text-gray-900">

        {{-- A barra do topo só aparece para quem está logado. --}}
        @auth
            <nav class="bg-white shadow">
                <div class="mx-auto flex max-w-4xl items-center justify-between px-4 py-3">
                    <span class="font-semibold">Cadastro de Alunos</span>

                    <div class="flex items-center gap-4 text-sm">
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>

                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">Sair</button>
                        </form>
                    </div>
                </div>
            </nav>
        @endauth

        <main class="mx-auto max-w-4xl p-4">
            {{ $slot }}
        </main>

    </body>
</html>
