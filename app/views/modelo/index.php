<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Modelos</h1>
    <a href="/modelo/create">Criar Modelo</a>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($modelos as $modelo): ?>
        <tr>
            <td><?= $modelo->id ?></td>
            <td><?= htmlspecialchars($modelo->modelo_nome) ?></td>
            <td>
                <a href="/modelos/<?= $modelo->modelo_id ?>">Ver</a>
                <a href="/modelos/<?= $modelo->modelo_id ?>/edit">Editar</a>
                <form action="/modelos/<?= $modelo->modelo_id ?>/delete" method="POST" style="display:inline;">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>