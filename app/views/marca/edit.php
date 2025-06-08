<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<div class="mx-auto col-6">
    <h3 class="text-info mt-3">Modificar uma marca</h3>
</div>

<form action="update" method="POST" class="col-6 mx-auto mb-3">
    <div class="mb-3">
        <input type="hidden" name="marca_id" id="marca_id" value="<?=$marca->marca_id?>">
        <input class="form-control item" type="text" id="marca_nome" name="marca_nome" 
        value="<?=$marca->marca_nome?>" required autofocus>
        <button class="btn btn-primary btn-block" type="submit">Salvar</button>
        <button type="button" onclick="location.href='/marcas'" class="btn btn-secondary">Voltar</button>
    </div>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>