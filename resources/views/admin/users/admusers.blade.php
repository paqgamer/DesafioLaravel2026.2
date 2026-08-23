<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Gerenciar Usuários | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admproducts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modaledit.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <x-navbar :categorias="[]" />

    <main class="admin-container">

        <div class="admin-header">
            <div>
                <h1>Gerenciamento de Usuários</h1>
                <p>Visualize e edite os dados dos usuários cadastrados.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        <div class="table-card">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="text-center">Admin</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>#{{ $usuario->id }}</td>
                            <td>
                                @if ($usuario->photo)
                                    <img src="{{ asset('storage/' . $usuario->photo) }}" alt="{{ $usuario->name }}"
                                        class="product-thumb">
                                @else
                                    <span class="material-symbols-outlined">account_circle</span>
                                @endif
                            </td>
                            <td class="font-bold">{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="text-center">
                                @if ($usuario->is_admin)
                                    <span class="badge">Admin</span>
                                @else
                                    <span class="empty-state">—</span>
                                @endif
                            </td>
                            <td class="actions-cell">

                                <button type="button" class="btn-action btn-edit" title="Editar"
                                    onclick='openEditModal({{ json_encode($usuario) }})'>
                                    <span class="material-symbols-outlined">edit</span>
                                </button>

                                @if ($usuario->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $usuario->id) }}" method="POST"
                                        class="inline-form"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Excluir">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Nenhum usuário cadastrado no momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-container">
                {{ $usuarios->links() }}
            </div>
        </div>

    </main>
    @include('admin.users.edit')
</body>
<script src="{{ asset('js/admusers.js') }}"></script>

</html>