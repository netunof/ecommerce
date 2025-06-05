<?php include_once __DIR__ . '/../layout/cabecalho.php';?>

<div class="mx-auto col-10">
    <h3 class="text-info mt-3">Cadastrar um produto</h3>
</div>

<form action="/produto/store" method="POST" class="col-10 mx-auto mb-3">
    <div class="row">
        <div class="col-6">
            <label for="produto_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="produto_nome" aria-describedby="produto_nome" name="produto_nome">
            <label for="produto_categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="produto_nome" aria-describedby="produto_nome" name="produto_nome">
            <label for="produto_marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="produto_nome" aria-describedby="produto_nome" name="produto_nome">
            <label for="produto_preco" class="form-label">Preço</label>
            <input type="number" step="0.01" min="0" class="form-control" id="produto_preco" aria-describedby="produto_preco" name="produto_preco">
            <label for="produto_estoque" class="form-label">Estoque</label>
            <input type="number" min="0" step="1" class="form-control" id="produto_estoque" aria-describedby="produto_estoque" name="produto_estoque">
        </div>
        <div class="col-6">
            <label for="produto_descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="produto_descricao" aria-describedby="produto_descricao" name="produto_descricao" rows="10">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" onclick="location.href='/'" class="btn btn-secondary">Voltar</button>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>