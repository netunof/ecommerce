<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-primary">
                        <i class="fas fa-tag me-2"></i>Detalhes da Marca
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/marcas">Marcas</a></li>
                            <li class="breadcrumb-item active">Detalhes</li>
                        </ol>
                    </nav>
                </div>
                <a href="/marcas" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if($marca->logo): ?>
                        <div class="text-center mb-4">
                            <img src="/uploads/marcas/<?= htmlspecialchars($marca->logo) ?>" 
                                 class="img-fluid rounded" style="max-height: 200px" 
                                 alt="Logo <?= htmlspecialchars($marca->marca_nome) ?>">
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" width="30%">ID</th>
                                <td><?= htmlspecialchars($marca->marca_id) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nome</th>
                                <td><?= htmlspecialchars($marca->marca_nome) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Criado em</th>
                                <td><?= date('d/m/Y H:i', strtotime($marca->created_at)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Criado por</th>
                                <td><?= htmlspecialchars($marca->created_by) ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="/marca/<?= htmlspecialchars($marca->marca_id) ?>/edit" 
                           class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>