<?php require_once 'layout/cabecalho.php'; ?>
<main class="page catalog-page">
    <section class="clean-block clean-catalog dark" style="padding:0;margin-top:0px;">
        <div class="container" style="margin-right:auto;margin-left:auto;">
            <div class="block-heading" style="padding-top:20px;padding-bottom:20px;margin-bottom:0px;">
                <div class="carousel slide" data-ride="carousel" id="carousel-2">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/banner1.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/banner2.png" alt="Slide Image"></div>
                        <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/banner3.jpg" alt="Slide Image"></div>
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
            </div>
            <div class="content">
                <div class="row" style="margin-right:0px;margin-left:0px;">
                    <div class="col-md-3">
                        <div class="d-none d-md-block">
                            <form action="index.php" method="GET">
                                <div class="filters" style="padding-left:30px;">
                                    <div class="filter-item">
                                        <h3>Categorias</h3>
                                        <?php if($data['categorias']){
                                            foreach ($data['categorias'] as $categoria): ?>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck-<?= $categoria->categoria_id?>" name="categoria_id[]" value="<?= $categoria->categoria_id ?>">
                                                <label class="form-check-label" for="formCheck-1"><?= $categoria->categoria_nome?></label>
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
                                <?php /*
                                include_once 'DAO.php';
                                $pesquisa = filter_input(INPUT_GET, 'pesquisa');
                                if (isset($_GET['tipo']) || isset($_GET['marca'])){
                                    $tipo = $_GET['tipo'];
                                    $marca = $_GET['marca'];
                                } 
                                if (isset($pesquisa)) {
                                    try {
                                        $stmt = $conn->prepare("SELECT idproduto, fotoproduto, nome, valor FROM Produto WHERE nome LIKE '%" . $pesquisa . "%'");
                                        $stmt->execute();

                                        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
                                            //define as colunas da tabela como variáveis pra passar via URL e pra preencher o escaninho
                                            $id = $result['idproduto'];
                                            echo '<div class="col-12 col-md-6 col-lg-4">
                                                        <a href="produto.php?id=' . $id . '">
                                                            <div class="clean-product-item">
                                                                <div class="image">
                                                                    <img width="160" height="160" class="img-fluid d-block mx-auto" src="assets/img/produtos/' . $result['fotoproduto'] . '">
                                                                </div>
                                                                <div class="product-name">
                                                                    <a href="#">' . $result['nome'] . '</a>
                                                                </div>
                                                                <div class="about">
                                                                    <div class="price">
                                                                        <h3>R$' . $result['valor'] . '</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>';
                                        }
                                    } catch (Exception $ex) {
                                        echo "Não foi possível consultar: " . $ex->getMessage();
                                    }
                                } elseif (isset($tipo) || isset($marca)) {
                                    
                                    try {
                                        $stmt = $conn->prepare("SELECT idproduto, fotoproduto, nome, valor
                                                FROM Produto WHERE categoria IN ('" . implode("', '", (array)$tipo) . "')
                                                OR marca IN ('" . implode("', '", (array)$marca) . "')");
                                        //var_dump($tipo);
                                        $stmt->execute();
                                        
                                        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
                                            //define as colunas da tabela como variáveis pra passar via URL e pra preencher o escaninho
                                            $id = $result['idproduto'];
                                            echo '<div class="col-12 col-md-6 col-lg-4">
                                                        <a href="produto.php?id=' . $id . '">
                                                            <div class="clean-product-item">
                                                                <div class="image">
                                                                    <img width="160" height="160" class="img-fluid d-block mx-auto" src="assets/img/produtos/' . $result['fotoproduto'] . '">
                                                                </div>
                                                                <div class="product-name">
                                                                    <a href="#">' . $result['nome'] . '</a>
                                                                </div>
                                                                <div class="about">
                                                                    <div class="price">
                                                                        <h3>R$' . $result['valor'] . '</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>';
                                        }
                                    } catch (Exception $ex) {
                                        echo "Não foi possível consultar: " . $ex->getMessage();
                                    }
                                } else {
                                    try {
                                        $stmt = $conn->prepare("SELECT idproduto, fotoproduto, nome, valor FROM Produto ORDER BY RAND()");
                                        $stmt->execute();

                                        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
                                            //define as colunas da tabela como variáveis pra passar via URL e pra preencher o escaninho
                                            $id = $result['idproduto'];
                                            echo '<div class="col-12 col-md-6 col-lg-4">
                                                        <a href="produto.php?id=' . $id . '">
                                                            <div class="clean-product-item">
                                                                <div class="image">
                                                                    <img width="160" height="160" class="img-fluid d-block mx-auto" src="assets/img/produtos/' . $result['fotoproduto'] . '">
                                                                </div>
                                                                <div class="product-name">
                                                                    <a href="#">' . $result['nome'] . '</a>
                                                                </div>
                                                                <div class="about">
                                                                    <div class="price">
                                                                        <h3>R$' . $result['valor'] . '</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>';
                                        }
                                    } catch (Exception $ex) {
                                        echo "Não foi possível consultar: " . $ex->getMessage();
                                    }
                                }
                                $conn = null;
                                */?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once 'layout/rodape.php'; ?>