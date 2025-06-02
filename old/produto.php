<?php
include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
try {
    $stmt = $conn->prepare("SELECT * FROM Produto WHERE idproduto=$id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "Não foi possível consultar: " . $ex->getMessage();
}
?>

<?php include_once 'topo.php';?>
        <main class="page product-page">
            <section class="clean-block clean-product dark" style="padding:0;margin:20px auto 0px auto;margin-top:0px;">
                <div class="container" style="margin:20px auto 0px auto;margin-top:0px;">
                    <div class="block-heading" style="padding-top:30px;padding-bottom:30px;margin-bottom:0px;">
                        
                    </div>
                    <div class="block-content">
                        <div class="product-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gallery">
                                        <div class="sp-wrap">
                                            <a href="assets/img/produtos/<?php echo $result['fotoproduto'];?>">
                                                <img class="img-fluid d-block mx-auto" src="assets/img/produtos/<?php echo $result['fotoproduto'];?>">
                                            </a>
                                            <a href="assets/img/produtos/<?php echo $result['fotoproduto1'];?>">
                                                <img class="img-fluid d-block mx-auto" src="assets/img/produtos/<?php echo $result['fotoproduto1'];?>">
                                            </a>
                                            <a href="assets/img/produtos/<?php echo $result['fotoproduto2'];?>">
                                                <img class="img-fluid d-block mx-auto" src="assets/img/produtos/<?php echo $result['fotoproduto2'];?>">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info">
                                        <h3><?php echo $result['nome'];?></h3>
                                        <div class="price">
                                            <h3>R$<?php echo $result['valor'];?></h3>
                                        </div>
                                        <!--PRODUTO ENVIA O ID PRO CARRINHO PROCESSAR-->
                                        <a href="<?php echo "carrinho.php?id=$id&acao=ins"?>">
                                            <button class="btn btn-primary" type="button"><i class="icon-basket"></i>Adicionar</button>
                                        </a>
                                        <?php
                                        
                                        ?>
                                                                                
                                        <div class="summary">
                                            <p><?php echo $result['descricao'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div>
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" role="tab" data-toggle="tab" href="#description" id="description-tab">Descrição</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" role="tab" data-toggle="tab" href="#specifications" id="specifications-tabs">Especificações técnicas</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                        <p><?php echo $result['descdetalhada'];?></p>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <figure class="figure"><img class="img-fluid figure-img" src="assets/img/produtos/<?php echo $result['fotofeature1'];?>"></figure>
                                            </div>
                                            <div class="col-md-7">
                                                <h4><?php echo $result['titulo1'];?></h4>
                                                <p><?php echo $result['feature1'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7 right">
                                                <h4><?php echo $result['titulo2'];?></h4>
                                                <p><?php echo $result['feature2'];?></p>
                                            </div>
                                            <div class="col-md-5">
                                                <figure class="figure"><img class="img-fluid figure-img" src="assets/img/produtos/<?php echo $result['fotofeature2'];?>"></figure>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show specifications" role="tabpanel" id="specifications">
                                        <div class="table-responsive table-bordered">
                                            <pre class="text-muted">
                                                <?php echo $result['specs'];?>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
        </main>
<?php include_once 'fundo.php';?>