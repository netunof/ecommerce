<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="text-info mt-4 mb-4">Cadastrar Novo Cliente</h1>
            
            <form action="/cliente/store" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="cliente_nome" class="form-label">Nome Completo *</label>
                    <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" required>
                    <div class="invalid-feedback">Por favor, informe o nome do cliente.</div>
                </div>
                
                <div class="mb-3">
                    <label for="cliente_cpf" class="form-label">CPF *</label>
                    <input type="text" class="form-control" id="cliente_cpf" name="cliente_cpf" required>
                    <div class="invalid-feedback">Por favor, informe o CPF.</div>
                </div>
                
                <div class="mb-3">
                    <label for="cliente_email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="cliente_email" name="cliente_email" required>
                    <div class="invalid-feedback">Por favor, informe um email válido.</div>
                </div>
                
                <div class="mb-3">
                    <label for="cliente_telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone">
                </div>

                <!-- Password Fields -->
                <div class="mb-3">
                    <label for="cliente_senha" class="form-label">Senha *</label>
                    <input type="password" class="form-control" id="cliente_senha" name="cliente_senha" required>
                    <div class="invalid-feedback">Por favor, informe uma senha.</div>
                </div>
                
                <div class="mb-3">
                    <label for="confirmar_senha" class="form-label">Confirmar Senha *</label>
                    <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    <div class="invalid-feedback">As senhas devem coincidir.</div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" onclick="location.href='/clientes'" 
                            class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Voltar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Salvar Cliente
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

            // Password confirmation validation
            const senha = document.getElementById('cliente_senha').value;
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            
            if (senha !== confirmarSenha) {
                event.preventDefault();
                event.stopPropagation();
                alert('As senhas não coincidem!');
                document.getElementById('confirmar_senha').classList.add('is-invalid');
            } else {
                document.getElementById('confirmar_senha').classList.remove('is-invalid');
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>