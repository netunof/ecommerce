<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Categorias</h1>
    <a href="/categoria/create" class="btn btn-success float-end">
        <i class="fa-solid fa-plus me-2"></i>Criar Categoria</a>
    
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
                <th scope="row"><?= $categoria->categoria_id ?></th>
                <td><?= htmlspecialchars($categoria->categoria_nome) ?></td>
                <td>
                    <a href="/categorias/<?= $categoria->categoria_id ?>" class="me-3">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="/categorias/<?= $categoria->categoria_id ?>/edit" class="me-3">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a href="/categorias/<?= $categoria->categoria_id ?>/delete" method="POST">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>