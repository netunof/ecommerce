<?php include_once __DIR__.'/../layout/cabecalho.php';?>
<div class="mx-auto col-6">
    <h3 class="text-info mt-3">Cadastrar uma marca</h3>
</div>

<form action="/marca/store" method="POST" class="col-6 mx-auto mb-3">
    <div class="mb-3">
        <label for="marca_nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="marca_nome" aria-describedby="emailHelp" name="marca_nome" autofocus>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" onclick="location.href='/marcas'" class="btn btn-secondary">Voltar</button>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>