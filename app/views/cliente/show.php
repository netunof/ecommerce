<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Categorias</h1>
    <a href="/categoria/create">Criar Categoria</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Criado em</th>
                <th scope="col">Criado por</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?= $categoria->categoria_id ?></th>
                <td><?= $categoria->categoria_nome ?></td>
                <td><?= $categoria->created_at ?></td>
                <td><?= $categoria->created_by ?></td>
            </tr>
        </tbody>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>