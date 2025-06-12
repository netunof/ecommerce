<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 text-primary">
                        <i class="fas fa-tags me-2"></i>Editar Categoria
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/categorias">Categorias</a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="update" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="categoria_id" value="<?= htmlspecialchars($categoria->categoria_id) ?>">
                        
                        <div class="mb-4">
                            <label for="categoria_nome" class="form-label fw-bold">Nome da Categoria *</label>
                            <input type="text" class="form-control form-control-lg" id="categoria_nome" 
                                   name="categoria_nome" required autofocus
                                   value="<?= htmlspecialchars($categoria->categoria_nome) ?>"
                                   minlength="2" maxlength="50">
                            <div class="invalid-feedback">
                                Por favor, insira um nome válido (2-50 caracteres).
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="/categorias" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Form validation
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