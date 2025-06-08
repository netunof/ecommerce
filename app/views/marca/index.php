<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<div class="col-8 mx-auto">
    <div class="row">
        <div class="col-6"><h1>Marcas</h1></div>
        <div class="col-6">
            <a href="/marca/create" class="btn btn-success float-end"><i class="fa-solid fa-plus me-2"></i>Criar Marca</a>
        </div>
    </div>    
        <?php if(!$marcas){?>
        <div>Nenhuma marca encontrada</div>
        <?php } else{?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marcas as $marca): ?>
                <tr>
                    <th scope="row" class="col-2"><?= $marca->marca_id ?></th>
                    <td class="col-8"><?= htmlspecialchars($marca->marca_nome) ?></td>
                    <td class="col-2">
                        <a href="/marca/<?= $marca->marca_id ?>" class="me-3">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="/marca/<?= $marca->marca_id ?>/edit" class="me-3">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="/marca/<?= $marca->marca_id ?>/delete" method="POST">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php }?>
</div>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>