# Cadastro de Alunos — Laravel + Livewire

Projeto de exemplo para aula: um CRUD simples de alunos com tela de login.

## Stack

- Laravel 13
- Livewire 4
- Tailwind CSS 4 (via Vite)
- Banco SQLite (nenhuma instalação de banco necessária)

## Como rodar

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed
npm run build

php artisan serve
```

Acesse http://127.0.0.1:8000

**Login:** `professor@escola.test` — **Senha:** `senha123`

> Durante o desenvolvimento, use `npm run dev` no lugar de `npm run build`
> para o CSS atualizar sozinho ao salvar os arquivos.

## Onde está cada coisa

| Arquivo | O que faz |
|---|---|
| `routes/web.php` | Define os endereços do site e quem pode acessar |
| `app/Models/Aluno.php` | Representa a tabela `alunos` no código |
| `database/migrations/*_create_alunos_table.php` | Cria a tabela `alunos` |
| `app/Livewire/Login.php` | Lógica da tela de login |
| `resources/views/livewire/login.blade.php` | HTML da tela de login |
| `app/Livewire/Alunos.php` | Lógica do CRUD (listar, criar, editar, excluir) |
| `resources/views/livewire/alunos.blade.php` | HTML do CRUD |
| `resources/views/layouts/app.blade.php` | Moldura da página (cabeçalho, menu) |
| `database/seeders/DatabaseSeeder.php` | Cria o usuário e os alunos de exemplo |

## A ideia central do Livewire

Cada componente tem **duas partes**: uma classe PHP e uma view Blade.

1. As **propriedades públicas** da classe (`public string $nome`) aparecem na tela.
2. `wire:model="nome"` liga um `<input>` a essa propriedade.
3. `wire:click="salvar"` chama o método `salvar()` da classe quando o botão é clicado.
4. O Livewire manda os dados ao servidor, roda o método e atualiza **só o pedaço**
   da página que mudou — sem você escrever nenhum JavaScript.

## Exercícios sugeridos

1. Adicionar um campo `matricula` (migration + model + formulário + tabela).
2. Ordenar a lista clicando no cabeçalho das colunas.
3. Paginar a listagem com `WithPagination` quando passar de 10 alunos.
4. Impedir que um aluno seja excluído sem confirmar digitando o nome.
