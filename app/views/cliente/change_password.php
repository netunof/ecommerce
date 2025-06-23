<?php include 'templates/header.php'; ?>

<div class="container mt-5">
    <h2>Alterar Senha</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="post" action="/cliente/<?= $cliente_id ?>/update-password">
        <?php if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']): ?>
            <div class="form-group">
                <label for="current_password">Senha Atual</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="new_password">Nova Senha</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirmar Nova Senha</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Alterar Senha</button>
        <a href="/perfil" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'templates/footer.php'; ?>