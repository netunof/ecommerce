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
                            <label for="categoria_fk" class="form-label">Categoria *</label>
                            <select name="categoria_fk" id="categoria_fk" class="form-select" required>
                                <option value="" selected disabled>Selecione uma categoria</option>
                                <?php foreach ($data['categorias'] as $categoria): ?>
                                <option value="<?= htmlspecialchars($categoria->categoria_id) ?>">
                                    <?= htmlspecialchars($categoria->categoria_nome) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Por favor, selecione uma categoria.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="marca_fk" class="form-label">Marca *</label>
                            <select name="marca_fk" id="marca_fk" class="form-select" required>
                                <option value="" selected disabled>Selecione uma marca</option>
                                <?php foreach ($data['marcas'] as $marca): ?>
                                <option value="<?= htmlspecialchars($marca->marca_id) ?>">
                                    <?= htmlspecialchars($marca->marca_nome) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
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