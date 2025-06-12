<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-primary">
                        <i class="fas fa-tags me-2"></i>Marcas
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Marcas</li>
                        </ol>
                    </nav>
                </div>
                <a href="/marca/create" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Nova Marca
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <?php if(empty($marcas)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-tag fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Nenhuma marca cadastrada</h4>
                            <p class="text-muted">Clique no botão "Nova Marca" para começar</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="80">ID</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col" width="120" class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($marcas as $marca): ?>
                                    <tr>
                                        <th scope="row"><?= htmlspecialchars($marca->marca_id) ?></th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if($marca->logo): ?>
                                                    <img src="/uploads/marcas/thumb_<?= htmlspecialchars($marca->logo) ?>" 
                                                         class="rounded me-3" width="40" height="40" 
                                                         alt="<?= htmlspecialchars($marca->marca_nome) ?>">
                                                <?php endif; ?>
                                                <a href="/marca/<?= htmlspecialchars($marca->marca_id) ?>" 
                                                   class="text-decoration-none">
                                                    <?= htmlspecialchars($marca->marca_nome) ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="/marca/<?= htmlspecialchars($marca->marca_id) ?>" 
                                                   class="btn btn-outline-primary" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/marca/<?= htmlspecialchars($marca->marca_id) ?>/edit" 
                                                   class="btn btn-outline-secondary" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/marca/<?= htmlspecialchars($marca->marca_id) ?>/delete" 
                                                      method="POST" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-outline-danger" 
                                                            title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta marca?')">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>