<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 text-primary">
                        <i class="fas fa-tag me-2"></i>Editar Marca
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/marcas">Marcas</a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="update" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <input type="hidden" name="marca_id" value="<?= htmlspecialchars($marca->marca_id) ?>">
                        
                        <div class="mb-4">
                            <label for="marca_nome" class="form-label fw-bold">Nome da Marca *</label>
                            <input type="text" class="form-control form-control-lg" id="marca_nome" 
                                   name="marca_nome" required autofocus
                                   value="<?= htmlspecialchars($marca->marca_nome) ?>"
                                   minlength="2" maxlength="50">
                            <div class="invalid-feedback">
                                Por favor, insira um nome válido (2-50 caracteres).
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="marca_logo" class="form-label fw-bold">Logo</label>
                            <?php if($marca->logo): ?>
                                <div class="mb-3">
                                    <img src="/uploads/marcas/<?= htmlspecialchars($marca->logo) ?>" 
                                         class="img-thumbnail mb-2" style="max-height: 100px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="remove_logo" name="remove_logo">
                                        <label class="form-check-label" for="remove_logo">
                                            Remover logo atual
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="marca_logo" 
                                   name="marca_logo" accept="image/png, image/jpeg, image/svg+xml">
                            <div class="form-text">
                                Formatos aceitos: PNG, JPEG, SVG. Tamanho máximo: 2MB.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="/marcas" class="btn btn-outline-secondary">
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