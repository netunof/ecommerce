<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h1 class="text-info mt-4 mb-4">Cadastrar Novo Produto</h1>
            
            <form action="store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_nome" class="form-label">Nome do Produto *</label>
                            <input type="text" class="form-control" id="produto_nome" name="produto_nome" required>
                            <div class="invalid-feedback">Por favor, informe o nome do produto.</div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="categoria_fk" class="form-label">Categoria *</label>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <select name="categoria_fk" id="categoria_fk" class="form-select" required>
                                        <option value="" selected disabled>Selecione uma categoria</option>
                                        <?php foreach ($data['categorias'] as $categoria): ?>
                                            <option value="<?= htmlspecialchars($categoria->categoria_id) ?>">
                                            <?= htmlspecialchars($categoria->categoria_nome) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-1" title="Nova categoria">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#novaCategoriaModal">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback">Por favor, selecione uma categoria.</div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="marca_fk" class="form-label">Marca *</label>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <select name="marca_fk" id="marca_fk" class="form-select" required>
                                        <option value="" selected disabled>Selecione uma marca</option>
                                        <?php foreach ($data['marcas'] as $marca): ?>
                                            <option value="<?= htmlspecialchars($marca->marca_id) ?>">
                                            <?= htmlspecialchars($marca->marca_nome) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-1" title="Nova marca">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#novaMarcaModal">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback">Por favor, selecione uma marca.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="produto_preco" class="form-label">Preço (R$) *</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" step="0.01" min="0" class="form-control" 
                                       id="produto_preco" name="produto_preco" required>
                            </div>
                            <div class="invalid-feedback">Por favor, informe um preço válido.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="produto_estoque" class="form-label">Quantidade em Estoque *</label>
                            <input type="number" min="0" step="1" class="form-control" 
                                   id="produto_estoque" name="produto_estoque" required>
                            <div class="invalid-feedback">Por favor, informe a quantidade em estoque.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_descricao" class="form-label">Descrição do Produto</label>
                            <textarea class="form-control" id="produto_descricao" name="produto_descricao" 
                                      rows="7" placeholder="Descreva as características do produto"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="produto_foto" class="form-label">Fotos do Produto</label>
                            <input type="file" class="form-control" id="produto_foto" 
                                   name="produto_fotos[]" accept="image/png, image/jpeg, image/webp" multiple>
                            <div class="form-text">Formatos aceitos: JPEG, PNG, WEBP. Máx. 5MB por imagem.</div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" onclick="location.href='/produtos'" 
                            class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Salvar Produto
                    </button>
                </div>
            </form>
            <!-- Modal Categoria -->
            <div class="modal fade" id="novaCategoriaModal" tabindex="-1" aria-labelledby="novaCategoriaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="novaCategoriaModalLabel">Adicionar Nova Categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formNovaCategoria">
                                <div class="mb-3">
                                    <label for="nova_categoria_nome" class="form-label">Nome da Categoria</label>
                                    <input type="text" class="form-control" id="nova_categoria_nome" required>
                                    <div class="invalid-feedback">Por favor, informe o nome da categoria.</div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="salvarNovaCategoria">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Marca -->
            <div class="modal fade" id="novaMarcaModal" tabindex="-1" aria-labelledby="novaMarcaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="novaMarcaModalLabel">Adicionar Nova Marca</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formNovaMarca">
                                <div class="mb-3">
                                    <label for="nova_marca_nome" class="form-label">Nome da Marca</label>
                                    <input type="text" class="form-control" id="nova_marca_nome" required>
                                    <div class="invalid-feedback">Por favor, informe o nome da marca.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="nova_marca_logo" class="form-label">Logo (Opcional)</label>
                                    <input type="file" class="form-control" id="nova_marca_logo" accept="image/png, image/jpeg, image/svg+xml">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="salvarNovaMarca">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Bootstrap form validation
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
</script>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>