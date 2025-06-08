<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<div class="col-8 mx-auto">
    <div class="row">
        <div class="col-6"><h1>Categorias</h1></div>
        <div class="col-6">
            <a href="/categoria/create" class="btn btn-success float-end"><i class="fa-solid fa-plus me-2"></i>Criar Categoria</a>
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
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <th scope="row" class="col-2"><?= $categoria->categoria_id ?></th>
                    <td class="col-8"><?= htmlspecialchars($categoria->categoria_nome) ?></td>
                    <td class="col-2">
                        <a href="/categoria/<?= $categoria->categoria_id ?>" class="me-3">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="/categoria/<?= $categoria->categoria_id ?>/edit" class="me-3">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="/categoria/<?= $categoria->categoria_id ?>/delete" method="POST">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>