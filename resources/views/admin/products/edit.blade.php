<link rel="stylesheet" href="{{ asset('css/modaledit.css') }}">

<div id="editProductModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">
        
        <div class="modal-header">
            <h2>Editar Produto</h2>
            <button type="button" class="close-btn" onclick="closeEditModal()">&times;</button>
        </div>

        <form id="editProductForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-body">
                
                <div class="form-group">
                    <label for="edit_name">Nome do Produto *</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_price">Preço (R$) *</label>
                        <input type="number" id="edit_price" name="price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_category_id">Categoria *</label>
                        <select id="edit_category_id" name="category_id" required>
                            <option value="">Selecione uma categoria...</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_image">Imagem do Produto</label>
                    <div class="image-preview-wrapper" style="position: relative; display: inline-block;">
                        <img id="edit_image_preview" src="" alt="Imagem atual" >
                        <button type="button" id="edit_image_clear" class="btn-clear-image" title="Cancelar nova imagem" >&times;</button>
                    </div>
                    <input type="file" id="edit_image" name="image" accept="image/png, image/jpeg, image/webp">
                    <small>Deixe em branco pra manter a imagem atual.</small>
                </div>

                <div class="form-group">
                    <label for="edit_description">Descrição</label>
                    <textarea id="edit_description" name="description" rows="3"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancelar</button>
                <button type="submit" class="btn-save">Guardar Alterações</button>
            </div>
        </form>

    </div>
</div>