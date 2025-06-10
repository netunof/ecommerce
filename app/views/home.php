<?php require_once 'layout/cabecalho.php'; ?>
    <div class="container">
        <div class="carousel slide" data-bs-ride="carousel" id="carousel-2">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item"><img class="w-100 d-block" src="public/assets/img/banner1.png" alt="Slide Image"></div>
                <div class="carousel-item"><img class="w-100 d-block" src="public/assets/img/banner2.png" alt="Slide Image"></div>
                <div class="carousel-item active"><img class="w-100 d-block" src="public/assets/img/banner3.png" alt="Slide Image"></div>
            </div>
            <div>
                <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carousel-2" data-slide-to="0"></li>
                <li data-target="#carousel-2" data-slide-to="1"></li>
                <li data-target="#carousel-2" data-slide-to="2" class="active"></li>
            </ol>
        </div>
        <div class="row mx-0">
            <div class="col-md-3 bg-secondary">
                <div>
                    <form action="index.php" method="GET">
                        <div>
                            <div>
                                <h3>Categorias</h3>
                                <?php if($data['categorias']){
                                    foreach ($data['categorias'] as $categoria): ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="formCheck-<?= $categoria->categoria_id?>" name="categoria_id[]" value="<?= $categoria->categoria_id ?>">
                                        <label class="form-check-label" for="formCheck-<?= $categoria->categoria_id?>"><?= $categoria->categoria_nome?></label>
                                    </div>
                                <?php endforeach;}
                                    else echo 'Nenhuma categoria cadastrada' ?>
                            </div>
                            <div class="filter-item">
                                <h3>Marcas</h3>
                                <?php if($data['marcas']){
                                    foreach ($data['marcas'] as $marca): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="formCheck-<?= $marca->marca_id?>" name="marca_id[]" value="<?= $marca->marca_id ?>">
                                        <label class="form-check-label" for="formCheck-1"><?= $marca->marca_nome?></label>
                                    </div>
                                <?php endforeach;}
                                    else echo 'Nenhuma marca cadastrada' ?>
                                <br>
                                <input type="submit" value="Filtrar" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            
            <div class="col-md-9">
                <div class="products">
                    <div class="row no-gutters">
                        <?php if($data['produtos']){
                            foreach ($data['produtos'] as $produto):?>
                            <div class="card" style="width: 18rem;">
                                <a href="produto/<?=$produto->produto_id?>">
                                    <img src="..." class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $produto->produto_nome?></h5>
                                    <p class="card-text">R$<?= $produto->produto_preco?></p>
                                    <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                                </div>
                            </div>
                        <?php endforeach;}
                            else echo 'Nenhum produto cadastrado' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'layout/rodape.php'; ?>