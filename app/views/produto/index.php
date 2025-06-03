<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<div class="col-8 mx-auto">
    <div class="row">
        <div class="col-6"><h1>Produtos</h1></div>
        <div class="col-6">
            <a href="/produto/create" class="btn btn-success float-end"><i class="fa-solid fa-plus me-2"></i>Criar Produto</a>
        </div>
    </div>    
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <th scope="row" class="col-2"><?= $produto->produto_id ?></th>
                    <td class="col-8"><?= htmlspecialchars($produto->produto_nome) ?></td>
                    <td class="col-2">
                        <a href="/produtos/<?= $produto->produto_id ?>" class="me-3">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="/produtos/<?= $produto->produto_id ?>/edit" class="me-3">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="/produtos/<?= $produto->produto_id ?>/delete" method="POST">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>