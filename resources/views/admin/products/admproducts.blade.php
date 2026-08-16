<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Gerenciar Produtos | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admproducts.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <x-navbar :categorias="$categorias" />

    <main class="admin-container">

        <div class="admin-header">
            <div>
                <h1>Gerenciamento de Produtos</h1>
                <p>Cadastre, edite ou remova produtos do catálogo.</p>
            </div>

            <a href="{{ route('admin.products.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                Novo Produto
            </a>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        <!-- em teoria não é pra dar erro -->
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
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produtos as $produto)
                        <tr>
                            <td>#{{ $produto->id }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $produto->image_url) }}" alt="{{ $produto->name }}"
                                    class="product-thumb">
                            </td>
                            <td class="font-bold">{{ $produto->name }}</td>
                            <td>
                                <span class="badge">
                                    {{ $produto->category->name ?? 'Sem Categoria' }}
                                </span>
                            </td>
                            <td class="price">{{ format_price($produto->price) }}</td>
                            <td class="actions-cell">

                                <a href="{{ route('products.show', $produto->id) }}" class="btn-action btn-view"
                                    title="Visualizar">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                <button type="button" class="btn-action btn-edit" title="Editar"
                                    onclick='openEditModal({{ json_encode($produto) }})'>
                                    <span class="material-symbols-outlined">edit</span>

                                </button>


                                <form action="{{ route('admin.products.destroy', $produto->id) }}" method="POST"
                                    class="inline-form"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Excluir">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Nenhum produto cadastrado no momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-container">
                {{ $produtos->links() }}
            </div>
        </div>

    </main>
    @include('admin.products.edit')
</body>
<script src="{{ asset('js/admproducts.js') }}"></script>

</html>