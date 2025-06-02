<?php include_once __DIR__.'/../layout/cabecalho.php';?>
<div class="mx-auto col-6">
    <h3 class="text-info mt-3">Cadastrar uma categoria</h3>
</div>

<form action="/categoria/store" method="POST" class="col-6 mx-auto mb-3">
    <div class="mb-3">
        <label for="categoria_nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="categoria_nome" aria-describedby="emailHelp" name="categoria_nome">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" onclick="location.href='/'" class="btn btn-secondary">Voltar</button>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>