<?php include_once __DIR__.'/../layout/cabecalho.php';?>

    <div class="container">
        <div class="block-content">
            <div class="product-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="gallery">
                            <div class="sp-wrap">
                                <?php foreach ($produtoFotos as $foto): ?>
                                <a href="<?=$foto->file_content?>"><img class="img-fluid d-block mx-auto" src="<?=$foto->file_content?>"></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <h3><?=$produto->produto_nome?></h3>
                            <div class="price">
                                <h3>R$<?=$produto->produto_preco?></h3>
                            </div>
                            <button class="btn btn-primary mt-3" type="button"><i class="icon-basket"></i>Adicionar</button>
                            <div class="mt-3">
                                <p><?=$produto->produto_descricao?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="clean-related-items">
                <h3>Produtos Relacionados</h3>
                <div class="items">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-lg-4">
                            <div class="clean-related-item">
                                <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                    <h4>R$300</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clean-related-item">
                                <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                    <h4>R$300</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="clean-related-item">
                                <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                    <h4>R$300</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once __DIR__ . '/../layout/rodape.php'; ?>