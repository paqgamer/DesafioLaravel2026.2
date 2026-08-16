<div id="createProductModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">
<!-- padronizar essa merda  pra ser um modal o mais igual  possivel ao  de editar -->
        <div class="modal-header">
            <h2>Novo Produto</h2>
            <button type="button" class="close-btn" onclick="closeCreateModal()">&times;</button>
        </div>

        <form id="createProductForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">

                <div class="form-group">
                    <label for="create_name">Nome do Produto *</label>
                    <input type="text" id="create_name" name="name" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="create_price">Preço (R$) *</label>
                        <input type="number" id="create_price" name="price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="create_category_id">Categoria *</label>
                        <select id="create_category_id" name="category_id" required>
                            <option value="">Selecione uma categoria...</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="create_image">Imagem do Produto *</label>
                    <div class="image-preview-wrapper" style="position: relative; display: inline-block;">
                        <img id="create_image_preview" class="image-preview-img" src="" alt="Pré-visualização" style="display: none;">
                        <button type="button" id="create_image_clear" class="image-preview-clear-btn" title="Remover imagem">&times;</button>
                    </div>
                    <input type="file" id="create_image" name="image" accept="image/png, image/jpeg, image/webp" required>
                </div>

                <div class="form-group">
                    <label for="create_description">Descrição</label>
                    <textarea id="create_description" name="description" rows="3"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeCreateModal()">Cancelar</button>
                <button type="submit" class="btn-save">Salvar Produto</button>
            </div>
        </form>

    </div>
</div>