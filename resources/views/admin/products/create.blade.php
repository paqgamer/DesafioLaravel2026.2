<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <title>Novo Produto | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
</head>

<body>

    <x-navbar :categorias="$categorias" />

    <main class="admin-container">
        
        <div class="admin-header">
            <div>
                <h1>Criar Novo Produto</h1>
                <p>Preencha os dados abaixo para adicionar um produto ao catálogo.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="back-link" style="margin: 0;">← Voltar</a>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Atenção!</strong> Verifique os erros abaixo:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nome do Produto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Tênis Nike Revolution" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Preço (R$) *</label>
                        <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" placeholder="Ex: 299.99" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria *</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Selecione uma categoria...</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_url">Caminho da Imagem *</label>
                    <input type="text" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="Ex: images/produtos/1.jpg" required>
                    <small>Por enquanto, insira o caminho local da imagem salva na pasta public.</small>
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" rows="4" placeholder="Detalhes do produto...">{{ old('description') }}</textarea>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-save">Salvar Produto</button>
                </div>

            </form>
        </div>

    </main>

</body>
</html>