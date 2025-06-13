<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-primary">Detalhes do Cliente</h1>
                <a href="/clientes" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="card-title"><?= htmlspecialchars($cliente->cliente_nome) ?></h5>
                        <hr>
                    </div>
                    
                    <div class="mb-3">
                        <p class="mb-1"><strong>CPF:</strong> <?= htmlspecialchars($cliente->cliente_cpf) ?></p>
                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($cliente->cliente_email) ?></p>
                        <p class="mb-1"><strong>Telefone:</strong> <?= htmlspecialchars($cliente->cliente_telefone) ?></p>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="/cliente/<?= $cliente->cliente_id ?>/edit" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                        <form action="/cliente/<?= $cliente->cliente_id ?>/delete" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                <i class="fas fa-trash-alt me-1"></i> Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>