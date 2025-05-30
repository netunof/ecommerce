<?php include_once 'topo.php'; ?>
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-1" name="tipo[]" value="acessorio">
                                            <label class="form-check-label" for="formCheck-1">Acessórios</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-2" name="tipo[]" value="armazenamento">
                                            <label class="form-check-label" for="formCheck-2">Armazenamento</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-3" name="tipo[]" value="gabinete">
                                            <label class="form-check-label" for="formCheck-3">Gabinetes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-4" name="tipo[]" value="memoria">
                                            <label class="form-check-label" for="formCheck-4">Memórias</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-5" name="tipo[]" value="periferico">
                                            <label class="form-check-label" for="formCheck-5">Periféricos</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-6" name="tipo[]" value="placamae">
                                            <label class="form-check-label" for="formCheck-6">Placas-mãe</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-7" name="tipo[]" value="placadevideo">
                                            <label class="form-check-label" for="formCheck-7">Placas de vídeo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-8" name="tipo[]" value="processador">
                                            <label class="form-check-label" for="formCheck-8">Processadores</label>
                                        </div>
                                    </div>
                                    <div class="filter-item">
                                        <h3>Marcas</h3>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-9" name="marca[]" value="amd">
                                            <label class="form-check-label" for="formCheck-9">AMD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-10" name="marca[]" value="asus">
                                            <label class="form-check-label" for="formCheck-10">Asus</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-11" name="marca[]" value="gigabyte">
                                            <label class="form-check-label" for="formCheck-11">Gigabyte</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-12" name="marca[]" value="intel">
                                            <label class="form-check-label" for="formCheck-12">Intel</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-13" name="marca[]" value="kingston">
                                            <label class="form-check-label" for="formCheck-13">Kingston</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-14" name="marca[]" value="logitech">
                                            <label class="form-check-label" for="formCheck-14">Logitech</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-15" name="marca[]" value="msi">
                                            <label class="form-check-label" for="formCheck-15">MSI</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-16" name="marca[]" value="razer">
                                            <label class="form-check-label" for="formCheck-16">Razer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-17" name="marca[]" value="seagate">
                                            <label class="form-check-label" for="formCheck-17">Seagate</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck-18" name="marca[]" value="wd">
                                            <label class="form-check-label" for="formCheck-18">WD</label>
                                        </div>
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
                                <?php
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
                                ?>

                            </div>
                            <!-- por enquanto fica sem implementar
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link">1</a></li>
                                    <li class="page-item"><a class="page-link">2</a></li>
                                    <li class="page-item"><a class="page-link">3</a></li>
                                    <li class="page-item"><a class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once 'fundo.php'; ?>