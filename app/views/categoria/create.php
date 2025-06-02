<?php include_once __DIR__.'/../layout/cabecalho.php';?>

<main class="page registration-page">
    <section class="clean-block clean-form dark" style="margin:20px auto 0px auto;padding-bottom:30px;">
        <div class="container" style="margin:0px auto;">
            <div class="block-heading" style="padding-top:30px;padding-bottom:30px;margin-bottom:0px;">
                <h2 class="text-center text-info">Cadastrar Categoria</h2>
            </div>
            <form action="/categoria/store" method="POST">
                <div class="form-group">
                    <label for="categoria_nome">Nome</label><input class="form-control item" type="text" id="categoria_nome" name="categoria_nome" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Salvar</button>
                <button class="btn btn-danger btn-block" type="reset">Limpar</button>
            </form>
        </div>
    </section>
</main>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>