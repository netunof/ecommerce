<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Categorias</h1>
    <a href="/produto/create">Criar Produto</a>
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
                <th scope="row"><?= $produto->produto_id ?></th>
                <td><?= $produto->produto_nome ?></td>
                <td><?= $produto->created_at ?></td>
                <td><?= $produto->created_by ?></td>
            </tr>
        </tbody>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>