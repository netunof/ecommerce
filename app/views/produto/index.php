<?php include_once __DIR__.'/../layout/cabecalho.php'; ?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Header with Create Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-primary">
                        <i class="fas fa-boxes me-2"></i>Produtos Cadastrados
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                        </ol>
                    </nav>
                </div>
                <a href="/produto/create" class="btn btn-success">
                    <i class="fas fa-plus-circle me-2"></i>Novo Produto
                </a>
            </div>

            <!-- Products Table -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <?php if($produtos): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="80">ID</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Estoque</th>
                                        <th scope="col" width="120" class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produtos as $produto): ?>
                                    <tr>
                                        <th scope="row"><?= htmlspecialchars($produto->produto_id) ?></th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if(isset($produto->foto_principal) && !empty($produto->foto_principal)): ?>
                                                    <img src="/uploads/produtos/thumb_<?= htmlspecialchars($produto->foto_principal) ?>" 
                                                         class="rounded me-3" width="40" height="40" 
                                                         alt="<?= htmlspecialchars($produto->produto_nome) ?>">
                                                <?php else: ?>
                                                    <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center me-3" 
                                                         style="width:40px;height:40px">
                                                        <i class="fas fa-box-open"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <a href="/produto/<?= htmlspecialchars($produto->produto_id) ?>" 
                                                   class="text-decoration-none">
                                                    <?= htmlspecialchars($produto->produto_nome) ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($produto->categoria_nome ?? 'N/A') ?></td>
                                        <td>R$ <?= number_format($produto->produto_preco, 2, ',', '.') ?></td>
                                        <td>
                                            <span class="badge bg-<?= ($produto->produto_estoque > 0) ? 'success' : 'danger' ?>">
                                                <?= htmlspecialchars($produto->produto_estoque) ?> un.
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="/produto/<?= htmlspecialchars($produto->produto_id) ?>/edit" 
                                                   class="btn btn-outline-secondary" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/produto/<?= htmlspecialchars($produto->produto_id) ?>/delete" 
                                                      method="POST" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-outline-danger" 
                                                            title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
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

                        <!-- Pagination -->
                        <?php if(isset($pager) && $pager->getPageCount() > 1): ?>
                            <div class="card-footer bg-white">
                                <?= $pager->links() ?>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Nenhum produto cadastrado</h4>
                            <p class="text-muted">Clique no botão "Novo Produto" para começar</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>