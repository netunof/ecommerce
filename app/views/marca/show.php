<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<h1>Marcas</h1>
    <a href="/marca/create">Criar Marca</a>
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
                <th scope="row"><?= $marca->marca_id ?></th>
                <td><?= $marca->marca_nome ?></td>
                <td><?= $marca->created_at ?></td>
                <td><?= $marca->created_by ?></td>
            </tr>
        </tbody>
    </table>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>