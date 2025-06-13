<?php include_once __DIR__ . '/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-primary">
                        <i class="fas fa-users me-2"></i>Clientes Cadastrados
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                        </ol>
                    </nav>
                </div>
                <a href="/cliente/create" class="btn btn-success">
                    <i class="fas fa-plus-circle me-2"></i>Novo Cliente
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <?php if($clientes): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col" class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <th scope="row"><?= htmlspecialchars($cliente->cliente_id) ?></th>
                                        <td><?= htmlspecialchars($cliente->cliente_nome) ?></td>
                                        <td><?= htmlspecialchars($cliente->cliente_cpf) ?></td>
                                        <td><?= htmlspecialchars($cliente->cliente_email) ?></td>
                                        <td><?= htmlspecialchars($cliente->cliente_telefone) ?></td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="/cliente/<?= htmlspecialchars($cliente->cliente_id) ?>" 
                                                   class="btn btn-outline-primary" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/cliente/<?= htmlspecialchars($cliente->cliente_id) ?>/edit" 
                                                   class="btn btn-outline-secondary" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/cliente/<?= htmlspecialchars($cliente->cliente_id) ?>/delete" 
                                                      method="POST" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-outline-danger" 
                                                            title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Nenhum cliente cadastrado</h4>
                            <p class="text-muted">Clique no botão "Novo Cliente" para começar</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>