<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-primary">
                        <i class="fas fa-tags me-2"></i>Categorias
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Categorias</li>
                        </ol>
                    </nav>
                </div>
                <a href="/categoria/create" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Nova Categoria
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="80">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Criado em</th>
                                    <th scope="col" width="120" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categorias as $categoria): ?>
                                <tr>
                                    <th scope="row"><?= htmlspecialchars($categoria->categoria_id) ?></th>
                                    <td>
                                        <a href="/categoria/<?= htmlspecialchars($categoria->categoria_id) ?>" 
                                           class="text-decoration-none">
                                            <?= htmlspecialchars($categoria->categoria_nome) ?>
                                        </a>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($categoria->created_at)) ?></td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="/categoria/<?= htmlspecialchars($categoria->categoria_id) ?>" 
                                               class="btn btn-outline-primary" title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/categoria/<?= htmlspecialchars($categoria->categoria_id) ?>/edit" 
                                               class="btn btn-outline-secondary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/categoria/<?= htmlspecialchars($categoria->categoria_id) ?>/delete" 
                                                  method="POST" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
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
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>