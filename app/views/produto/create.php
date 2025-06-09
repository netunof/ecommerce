<?php include_once __DIR__ . '/../layout/cabecalho.php';?>

<div class="mx-auto col-10">
    <h3 class="text-info mt-3">Cadastrar um produto</h3>
</div>

<form action="store" method="POST" class="col-10 mx-auto mb-3">
    <div class="row">
        <div class="col-6">
            <label for="produto_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="produto_nome" aria-describedby="produto_nome" name="produto_nome" required>
            <label for="categoria_fk" class="form-label">Categoria</label>
            <select name="categoria_fk" id="categoria_fk" class="form-select" aria-label="Default select example" required>
                <option value="" selected disabled hidden>Selecione</option>
                <?php foreach ($data['categorias'] as $categoria): ?>
                <option value="<?=$categoria->categoria_id?>"><?=$categoria->categoria_nome?></option>
                <?php endforeach; ?>
            </select>
            <label for="marca_fk" class="form-label">Marca</label>
            <select name="marca_fk" id="marca_fk" class="form-select" aria-label="Default select example" required>
                <option value="" selected disabled hidden>Selecione</option>
                <?php foreach ($data['marcas'] as $marca): ?>
                <option value="<?=$marca->marca_id?>"><?=$marca->marca_nome?></option>
                <?php endforeach; ?>
            </select>
            <label for="produto_preco" class="form-label">Preço</label>
            <input type="number" step="0.01" min="0" class="form-control" id="produto_preco" aria-describedby="produto_preco" name="produto_preco" required>
            <label for="produto_estoque" class="form-label">Estoque</label>
            <input type="number" min="0" step="1" class="form-control" id="produto_estoque" aria-describedby="produto_estoque" name="produto_estoque" required>
        </div>
        <div class="col-6">
            <label for="produto_descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="produto_descricao" aria-describedby="produto_descricao" name="produto_descricao" rows="7"></textarea>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" onclick="location.href='/produtos'" class="btn btn-secondary">Voltar</button>
    </div>
</form>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>