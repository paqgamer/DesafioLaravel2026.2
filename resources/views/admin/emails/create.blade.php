<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <title>Enviar E-mail | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modaledit.css') }}">
</head>

<body>

    <x-navbar :categorias="[]" />

    <main class="admin-container">

        <div class="admin-header">
            <div>
                <h1>Mandar E-mail</h1>
                <p>Mandar uma mensagem para qualquer usuário cadastrado.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

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
            <form action="{{ route('admin.emails.send') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="user_id">Destinatário *</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">Selecione um usuário...</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} ({{ $usuario->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Assunto *</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="body">Mensagem *</label>
                    <textarea id="body" name="body" rows="8" maxlength="5000" required>{{ old('body') }}</textarea>
                </div>

                <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 16px;">
                    <button type="submit" class="btn-save">Enviar E-mail</button>
                </div>

            </form>
        </div>

    </main>

</body>
</html>