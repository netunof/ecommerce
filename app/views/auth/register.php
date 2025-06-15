<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="/public/img/logo.png" alt="Logo" class="img-fluid mb-3" width="150">
                        <h2 class="h4">Crie sua conta</h2>
                    </div>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form action="/registro/submit" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <div class="invalid-feedback">Por favor, informe seu nome.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF *</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required>
                            <div class="invalid-feedback">Por favor, informe seu CPF.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Por favor, informe um email válido.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                        
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha *</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                            <div class="invalid-feedback">Por favor, informe uma senha.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirmar_senha" class="form-label">Confirmar Senha *</label>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                            <div class="invalid-feedback">Por favor, confirme sua senha.</div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-1"></i> Cadastrar
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Já tem uma conta? <a href="/login" class="text-decoration-none">Faça login</a></p>
                        </div>
                    </form>
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
            
            // Check if passwords match
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            
            if (senha !== confirmarSenha) {
                event.preventDefault();
                event.stopPropagation();
                alert('As senhas não coincidem!');
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>