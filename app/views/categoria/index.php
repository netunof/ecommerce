<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Categorias</h1>
    <a href="/categoria/create">Criar Categoria</a>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td><?= $categoria->categoria_id ?></td>
            <td><?= htmlspecialchars($categoria->categoria_nome) ?></td>
            <td>
                <a href="/categorias/<?= $categoria->categoria_id ?>">Ver</a>
                <a href="/categorias/<?= $categoria->categoria_id ?>/edit">Editar</a>
                <form action="/categorias/<?= $categoria->categoria_id ?>/delete" method="POST" style="display:inline;">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>