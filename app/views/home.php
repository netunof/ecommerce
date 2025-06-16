<?php require_once 'layout/cabecalho.php'; ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- FILTROS -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/" method="GET" id="filterForm">
                        <!-- CATEGORIAS -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 border-bottom pb-2">Categorias</h5>
                            <?php if (!empty($data['categorias'])): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($data['categorias'] as $categoria): ?>
                                        <div class="list-group-item border-0 px-0 py-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="categoria-<?= $categoria->categoria_id ?>" 
                                                       name="categoria_id[]" 
                                                       value="<?= $categoria->categoria_id ?>"
                                                       <?= isset($_GET['categoria_id']) && in_array($categoria->categoria_id, (array)$_GET['categoria_id']) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="categoria-<?= $categoria->categoria_id ?>">
                                                    <?= htmlspecialchars($categoria->categoria_nome) ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Nenhuma categoria cadastrada</p>
                            <?php endif; ?>
                        </div>

                        <!-- MARCAS -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 border-bottom pb-2">Marcas</h5>
                            <?php if (!empty($data['marcas'])): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($data['marcas'] as $marca): ?>
                                        <div class="list-group-item border-0 px-0 py-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="marca-<?= $marca->marca_id ?>" 
                                                       name="marca_id[]" 
                                                       value="<?= $marca->marca_id ?>"
                                                       <?= isset($_GET['marca_id']) && in_array($marca->marca_id, (array)$_GET['marca_id']) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="marca-<?= $marca->marca_id ?>">
                                                    <?= htmlspecialchars($marca->marca_nome) ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Nenhuma marca cadastrada</p>
                            <?php endif; ?>
                        </div>

                        <!-- PREÇO -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 border-bottom pb-2">Faixa de Preço</h5>
                            <div class="px-2">
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="number" class="form-control form-control-sm" placeholder="Mínimo" name="preco_min" value="0">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control form-control-sm" placeholder="Máximo" name="preco_max" value="999999">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
                        <button type="reset" class="btn btn-outline-secondary w-100 mt-2" onclick="document.location='/';">Limpar Filtros</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- PRODUTOS -->
        <div class="col-lg-9 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Produtos</h2>
                <div class="d-flex">
                    <select class="form-select form-select-sm me-2" style="width: 180px;">
                        <option>Ordenar por</option>
                        <option value="preco_asc">Preço: Menor para Maior</option>
                        <option value="preco_desc">Preço: Maior para Menor</option>
                        <option value="nome_asc">Nome: A-Z</option>
                        <option value="nome_desc">Nome: Z-A</option>
                    </select>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary active"><i class="bi bi-grid"></i></button>
                        <button type="button" class="btn btn-outline-secondary"><i class="bi bi-list"></i></button>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <?php if (!empty($data['produtos'])): ?>
                    <?php foreach ($data['produtos'] as $produto): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm product-card">
                                <!-- FOTO -->
                                <div class="position-relative">
                                    <a href="produto/<?= $produto->produto_id ?>">
                                        <img src="/public/img/produtos/<?= htmlspecialchars($produto->file_name ?? 'default.jpg') ?>" 
                                             class="card-img-top p-3 object-fit-contain" 
                                             alt="<?= htmlspecialchars($produto->produto_nome) ?>"
                                             style="height: 200px;">
                                    </a>
                                </div>
                                
                                <!-- DETALHES -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="produto/<?= $produto->produto_id ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($produto->produto_nome) ?>
                                        </a>
                                    </h5>
                                    <h6 class="card-title">
                                        <a href="produto/<?= $produto->produto_id ?>" class="text-decoration-none text-dark">
                                            R$<?= htmlspecialchars($produto->produto_preco) ?>
                                        </a>
                                    </h6>
                                    
                                    <div class="mt-auto">   
                                        <button class="btn btn-outline-primary w-100 add-to-cart" 
                                                data-product-id="<?= $produto->produto_id ?>">
                                            <i class="bi bi-cart-plus me-2"></i>Adicionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Nenhum produto encontrado. Tente ajustar seus filtros.
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- PAGINAÇÃO -->
            <?php if (!empty($data['pagination'])): ?>
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <?php foreach ($data['pagination']['links'] as $link): ?>
                            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $link['url'] ?>"><?= $link['label'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once 'layout/rodape.php'; ?>