<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="/public/img/logo.png" alt="Logo" class="img-fluid mb-3" width="150">
                        <h2 class="h4">Acesse sua conta</h2>
                    </div>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form action="/login/submit" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-1"></i> Entrar
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <a href="/esqueci-senha" class="text-decoration-none">Esqueceu sua senha?</a>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer text-center py-3">
                    <p class="mb-0">Não tem uma conta? <a href="/registro" class="text-decoration-none">Cadastre-se</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>