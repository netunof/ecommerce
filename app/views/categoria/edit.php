<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<div class="mx-auto col-6">
    <h3 class="text-info mt-3">Modificar uma categoria</h3>
</div>

<form action="update" method="POST" class="col-6 mx-auto mb-3">
    <div class="mb-3">
        <input type="hidden" name="categoria_id" id="categoria_id" value="<?=$categoria->categoria_id?>">
        <input class="form-control item" type="text" id="categoria_nome" name="categoria_nome" 
        value="<?=$categoria->categoria_nome?>" required autofocus>
        <button class="btn btn-primary btn-block" type="submit">Salvar</button>
        <button type="button" onclick="location.href='/categorias'" class="btn btn-secondary">Voltar</button>
    </div>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>