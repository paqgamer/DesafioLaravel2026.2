<div id="createUserModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">

        <div class="modal-header">
            <h2>Novo Usuário</h2>
            <button type="button" class="close-btn" onclick="closeCreateModal()">&times;</button>
        </div>

        <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">

                <div class="form-group">
                    <label for="create_photo">Foto (opcional)</label>
                    <div class="image-preview-wrapper" style="position: relative; display: inline-block;">
                        <img id="create_photo_preview" class="image-preview-img" src="" alt="Pré-visualização" style="display: none;">
                        <button type="button" id="create_photo_clear" class="image-preview-clear-btn" title="Remover foto">&times;</button>
                    </div>
                    <input type="file" id="create_photo" name="photo" accept="image/png, image/jpeg, image/webp">
                </div>

                <div class="form-group">
                    <label for="create_name">Nome *</label>
                    <input type="text" id="create_name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="create_email">E-mail *</label>
                    <input type="email" id="create_email" name="email" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_password">Senha *</label>
                        <input type="password" id="create_password" name="password" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <label for="create_password_confirmation">Confirmar Senha *</label>
                        <input type="password" id="create_password_confirmation" name="password_confirmation" minlength="8" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_phone">Telefone *</label>
                        <input type="text" id="create_phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="create_birth_date">Data de Nascimento *</label>
                        <input type="date" id="create_birth_date" name="birth_date" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_cpf">CPF *</label>
                        <input type="text" id="create_cpf" name="cpf" required>
                    </div>

                    <div class="form-group">
                        <label for="create_saldo">Saldo (R$) *</label>
                        <input type="number" id="create_saldo" name="saldo" step="0.01" min="0" value="0" required>
                    </div>
                </div>

                <hr>
                <strong>Endereço</strong>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_cep">CEP *</label>
                        <input type="text" id="create_cep" name="cep" maxlength="9" required>
                    </div>

                    <div class="form-group">
                        <label for="create_number">Número *</label>
                        <input type="text" id="create_number" name="number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="create_street">Logradouro *</label>
                    <input type="text" id="create_street" name="street" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_neighborhood">Bairro *</label>
                        <input type="text" id="create_neighborhood" name="neighborhood" required>
                    </div>

                    <div class="form-group">
                        <label for="create_city">Cidade *</label>
                        <input type="text" id="create_city" name="city" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="create_state">Estado *</label>
                    <input type="text" id="create_state" name="state" maxlength="2" required>
                </div>

                <div class="form-group">
                    <label for="create_complement">Complemento (Opcional)</label>
                    <input type="text" id="create_complement" name="complement">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeCreateModal()">Cancelar</button>
                <button type="submit" class="btn-save">Salvar Usuário</button>
            </div>
        </form>

    </div>
</div>