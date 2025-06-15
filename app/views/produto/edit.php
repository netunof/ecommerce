<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-primary">
                    <i class="bi bi-pencil-square me-2"></i>Editar Produto: <?= htmlspecialchars($produto->produto_nome) ?>
                </h1>
                <a href="/produtos" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <form action="update" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="produto_id" value="<?= htmlspecialchars($produto->produto_id) ?>">
                
                <div class="row g-4">
                    <!-- INFO PRODUTO -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-muted border-bottom pb-2">Informações Básicas</h5>
                                
                                <div class="mb-3">
                                    <label for="produto_nome" class="form-label">Nome do Produto *</label>
                                    <input type="text" class="form-control" id="produto_nome" name="produto_nome" 
                                           value="<?= htmlspecialchars($produto->produto_nome) ?>" required>
                                    <div class="invalid-feedback">Por favor, informe o nome do produto.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="categoria_fk" class="form-label">Categoria *</label>
                                    <select name="categoria_fk" id="categoria_fk" class="form-select" required>
                                        <option value="" disabled>Selecione uma categoria</option>
                                        <?php foreach ($data['categorias'] as $categoria): ?>
                                        <option value="<?= htmlspecialchars($categoria->categoria_id) ?>" 
                                            <?= ($produto->categoria_fk == $categoria->categoria_id) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($categoria->categoria_nome) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione uma categoria.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="marca_fk" class="form-label">Marca *</label>
                                    <select name="marca_fk" id="marca_fk" class="form-select" required>
                                        <option value="" disabled>Selecione uma marca</option>
                                        <?php foreach ($data['marcas'] as $marca): ?>
                                        <option value="<?= htmlspecialchars($marca->marca_id) ?>" 
                                            <?= ($produto->marca_fk == $marca->marca_id) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($marca->marca_nome) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">Por favor, selecione uma marca.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- DETALHE PRODUTO -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-muted border-bottom pb-2">Detalhes do Produto</h5>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="produto_preco" class="form-label">Preço (R$) *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">R$</span>
                                                <input type="number" step="0.01" min="0" class="form-control" 
                                                       id="produto_preco" name="produto_preco" 
                                                       value="<?= htmlspecialchars($produto->produto_preco) ?>" required>
                                            </div>
                                            <div class="invalid-feedback">Informe um preço válido.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="produto_estoque" class="form-label">Estoque *</label>
                                            <input type="number" min="0" step="1" class="form-control" 
                                                   id="produto_estoque" name="produto_estoque" 
                                                   value="<?= htmlspecialchars($produto->produto_estoque) ?>" required>
                                            <div class="invalid-feedback">Informe a quantidade em estoque.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="produto_descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="produto_descricao" name="produto_descricao" 
                                              rows="5" placeholder="Descreva detalhes sobre o produto..."><?= htmlspecialchars($produto->produto_descricao) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- FOTOS -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted border-bottom pb-2">Fotos do Produto</h5>
                                
                                <!-- ATUAIS -->
                                <div class="mb-4">
                                    <h6 class="mb-3">Fotos Atuais</h6>
                                    <?php if (!empty($fotos)): ?>
                                        <div class="row g-3" id="current-photos">
                                            <?php foreach ($fotos as $foto): ?>
                                                <div class="col-6 col-md-3 col-lg-2 photo-item">
                                                    <div class="card h-100">
                                                        <img src="/<?= htmlspecialchars($foto->file_path) ?>" 
                                                            class="card-img-top img-thumbnail" 
                                                            alt="Foto do produto <?= htmlspecialchars($produto->produto_nome) ?>">
                                                        <div class="card-body p-2 text-center">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" 
                                                                    name="primary_photo" 
                                                                    id="primary_<?= $foto->produto_foto_id ?>"
                                                                    value="<?= $foto->produto_foto_id ?>"
                                                                    <?= $foto->is_primary ? 'checked' : '' ?>>
                                                                <label class="form-check-label small" for="primary_<?= $foto->produto_foto_id ?>">
                                                                    Principal
                                                                </label>
                                                            </div>
                                                            <button type="button" class="btn btn-sm btn-outline-danger delete-photo mt-2"
                                                                    data-foto-id="<?= htmlspecialchars($foto->produto_foto_id) ?>">
                                                                <i class="bi bi-trash"></i> Remover
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <input type="hidden" name="deleted_photos" id="deleted_photos" value="">
                                    <?php else: ?>
                                        <div class="alert alert-info">Nenhuma foto cadastrada para este produto.</div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- NOVAS -->
                                <div class="mb-3">
                                    <label for="novas_fotos" class="form-label">Adicionar Novas Fotos</label>
                                    <input type="file" class="form-control" id="novas_fotos" 
                                           name="novas_fotos[]" multiple accept="image/jpeg, image/png, image/webp">
                                    <div class="form-text">Formatos aceitos: JPEG, PNG, WEBP. Máx. 5MB por imagem.</div>
                                </div>
                                
                                <!-- ANTIGAS -->
                                <?php if (!empty($produto->fotos)): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Foto Principal</label>
                                        <div class="btn-group" role="group">
                                            <?php foreach ($produto->fotos as $foto): ?>
                                                <input type="radio" class="btn-check" name="foto_principal" 
                                                       id="foto_principal_<?= $foto->produto_foto_id ?>" 
                                                       value="<?= $foto->produto_foto_id ?>"
                                                       <?= ($foto->produto_foto_id == $produto->foto_principal_id) ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-primary" for="foto_principal_<?= $foto->produto_foto_id ?>">
                                                    <img src="/uploads/produtos/<?= htmlspecialchars($foto->foto_nome) ?>" 
                                                         class="img-thumbnail" width="50">
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- BOTÕES -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-outline-danger">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Limpar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- DELETE MODAL -->
<div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja remover esta foto?</p>
                <input type="hidden" id="foto_id_to_delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeletePhoto">Remover Foto</button>
            </div>
        </div>
    </div>
</div>

<script>
// VALIDAÇÕES
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()

// Photo deletion handling
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = new bootstrap.Modal(document.getElementById('deletePhotoModal'))
    let fotoIdToDelete = null;
    const deletedPhotosInput = document.getElementById('deleted_photos');
    let deletedPhotos = [];
    
    // Set up delete buttons
    document.querySelectorAll('.delete-photo').forEach(button => {
        button.addEventListener('click', function() {
            fotoIdToDelete = this.getAttribute('data-foto-id')
            deleteModal.show()
        })
    })
    
    // Confirm deletion
    document.getElementById('confirmDeletePhoto').addEventListener('click', function() {
        if (fotoIdToDelete) {
            // Add to deleted photos array
            deletedPhotos.push(fotoIdToDelete);
            deletedPhotosInput.value = deletedPhotos.join(',');
            
            // Remove the photo element from the DOM
            document.querySelector(`.photo-item [data-foto-id="${fotoIdToDelete}"]`).closest('.photo-item').remove();
            
            // Show success message
            alert('Foto marcada para remoção! As alterações serão salvas quando você enviar o formulário.');
            
            deleteModal.hide();
        }
    });
});
</script>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>