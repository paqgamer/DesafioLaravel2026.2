<div id="editUserModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">

        <div class="modal-header">
            <h2>Editar Usuário</h2>
            <button type="button" class="close-btn" onclick="closeEditModal()">&times;</button>
        </div>

        <form id="editUserForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-body">

                <div class="form-group">
                    <label for="edit_photo">Foto (opcional)</label>
                    <div class="image-preview-wrapper" style="position: relative; display: inline-block;">
                        <img id="edit_photo_preview" class="image-preview-img" src="" alt="Foto de perfil" style="display: none;">
                        <button type="button" id="edit_photo_clear" class="image-preview-clear-btn" title="Cancelar nova foto">&times;</button>
                    </div>
                    <input type="file" id="edit_photo" name="photo" accept="image/png, image/jpeg, image/webp">
                    <small>Deixe em branco pra manter a foto atual (ou não ter foto).</small>
                </div>

                <div class="form-group">
                    <label for="edit_name">Nome *</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="edit_email">E-mail *</label>
                    <input type="email" id="edit_email" name="email" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_phone">Telefone *</label>
                        <input type="text" id="edit_phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_birth_date">Data de Nascimento *</label>
                        <input type="date" id="edit_birth_date" name="birth_date" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_cpf">CPF *</label>
                        <input type="text" id="edit_cpf" name="cpf" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_saldo">Saldo (R$) *</label>
                        <input type="number" id="edit_saldo" name="saldo" step="0.01" min="0" required>
                    </div>
                </div>

                <hr>
                <strong>Endereço</strong>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_cep">CEP *</label>
                        <input type="text" id="edit_cep" name="cep" maxlength="9" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_number">Número *</label>
                        <input type="text" id="edit_number" name="number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_street">Logradouro *</label>
                    <input type="text" id="edit_street" name="street" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_neighborhood">Bairro *</label>
                        <input type="text" id="edit_neighborhood" name="neighborhood" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_city">Cidade *</label>
                        <input type="text" id="edit_city" name="city" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_state">Estado *</label>
                    <input type="text" id="edit_state" name="state" maxlength="2" required>
                </div>

                <div class="form-group">
                    <label for="edit_complement">Complemento (Opcional)</label>
                    <input type="text" id="edit_complement" name="complement">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancelar</button>
                <button type="submit" class="btn-save">Guardar Alterações</button>
            </div>
        </form>

    </div>
</div>