<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="/public/img/user-avatar.png" alt="Avatar" class="rounded-circle mb-3" width="100">
                    <h5 class="card-title"><?= htmlspecialchars($cliente->cliente_nome) ?></h5>
                    <p class="text-muted mb-1"><?= htmlspecialchars($cliente->cliente_email) ?></p>
                    <p class="text-muted"><?= htmlspecialchars($cliente->cliente_telefone) ?></p>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/perfil" class="list-group-item list-group-item-action active">Meus Dados</a>
                    <a href="/perfil/endereco" class="list-group-item list-group-item-action">Endereço</a>
                    <a href="/perfil/pedidos" class="list-group-item list-group-item-action">Meus Pedidos</a>
                    <a href="/logout" class="list-group-item list-group-item-action text-danger">Sair</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Dados atualizados com sucesso!</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Ocorreu um erro ao atualizar os dados.</div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Meus Dados</h5>
                </div>
                <div class="card-body">
                    <form action="/perfil/atualizar" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cliente_nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" 
                                    value="<?= htmlspecialchars($cliente->cliente_nome) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cliente_cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cliente_cpf" name="cliente_cpf" 
                                    value="<?= htmlspecialchars($cliente->cliente_cpf) ?>" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cliente_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="cliente_email" name="cliente_email" 
                                    value="<?= htmlspecialchars($cliente->cliente_email) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cliente_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone" 
                                    value="<?= htmlspecialchars($cliente->cliente_telefone ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nova_senha" class="form-label">Nova Senha (deixe em branco para não alterar)</label>
                                <input type="password" class="form-control" id="nova_senha" name="nova_senha">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                Excluir Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal para excluir conta -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar Exclusão de Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>
                <p>Todos os seus dados serão removidos permanentemente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="/perfil/excluir" method="POST">
                    <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>