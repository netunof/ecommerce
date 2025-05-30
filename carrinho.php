<?php
include 'topo.php';
$id = filter_input(INPUT_GET, 'id');
//DEFINE CARRINHO COMO UMA ARRAY
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}
if (isset($_GET['acao'])) {
    //insere produtos no carrinho pegando o índice do id e adicionando 1
    if ($_GET['acao'] == 'ins') {
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id] += 1;
        }
    }
    //remover produtos do carrinho
    if ($_GET['acao'] == 'del') {
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }
    //atualizar quantidade de produtos
    if ($_GET['acao'] == 'upd') {
        if (isset($_POST['prod']) && is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                $id = intval($id);
                $qtd = intval($qtd);
                if (!empty($qtd) || $qtd != 0) {
                    $_SESSION['carrinho'][$id] = $qtd;
                } else {
                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }
    }
}
?>
<?php include_once 'topo.php'; ?>

<main class="page shopping-cart-page">
    <section class="clean-block clean-cart dark" style="padding-bottom:30px;margin-top:0px;">
        <div class="container">
            <div class="block-heading" style="padding-top:30px;margin-bottom:0px;padding-bottom:30px;">
                <h2 class="text-center text-info">Seu carrinho</h2>
                <p>Escolha a quantidade ou exclua produtos</p>
            </div>
            <a href="index.php"><button class="btn btn-block btn-danger">CONTINUAR COMPRANDO</button></a>
            <div class="content">
                <form action="?acao=upd" method="post">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">
                                <?php
                                $subtotal = 0;
                                $total = 0;
                                //se tiver produtos no carrinho faz a listagem deles e soma o total
                                if (count($_SESSION['carrinho']) == 0) {
                                    echo "<div class='jumbotron text-center'>Carrinho vazio</div>";
                                } else {
                                    include 'DAO.php';
                                    //AQUI ELE DEFINE CADA ITEM DO CARRINHO COMO UMA QUANTIDADE ASSOCIADA À ID DO PRODUTO
                                    $x = 0;
                                    foreach ($_SESSION['carrinho'] as $id => $qtd) {
                                        $_SESSION['idvendaprod'][$x] = $id;
                                        $x++;
                                        try {
                                            $stmt = $conn->prepare("SELECT * FROM Produto WHERE idproduto=$id");
                                            $stmt->execute();
                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $subtotal = $qtd * $result['valor'];
                                            $total += $subtotal;
                                        } catch (Exception $ex) {
                                            echo "Não foi possível consultar: " . $ex->getMessage();
                                        }
                                        //CRIA A LISTA DE PRODUTOS NO CARRINHO PEGANDO O ID
                                        echo "
                                    <div class='product'>
                                        <div class='row justify-content-center align-items-center'>
                                            <div class='col-md-3'>
                                                <a href='?acao=del&id=$id'>remover</a>
                                                <div class='product-image'>
                                                    <img class='img-fluid d-block mx-auto image' src='assets/img/produtos/" . $result['fotoproduto'] . "'>
                                                </div>
                                            </div>
                                            <div class='col-md-5 product-info'><a href='produto.php?id=$id' class='product-name'>" . $result['nome'] . "</a>
                                                
                                            </div>
                                            <div class='col-6 col-md-2 quantity'>
                                                <label class='d-none d-md-block' for='quantity'>Quantia</label>
                                                <input type='number' name='prod[" . $id . "]' value='$qtd' id='number' class='form-control quantity-input'>
                                            </div>
                                            <div class='col-6 col-md-2 price'>
                                                <span>" . $result['valor'] . "</span>
                                            </div>
                                        </div>
                                    </div>";
                                    }
                                }
                                ?>

                            </div>
                            <input type="submit" class="btn btn-warning" value="Atualizar carrinho">
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Total</h3>

                                <!--CARRINHO NÃO ENVIA NADA VIA URL, ELE MANDA VIA SESSION-->
                                <h4><span class="display-4">R$<?php echo $total; ?></span></h4>
                                <a href="carrinhovalida.php">
                                    <button class="btn btn-primary btn-block btn-lg" type="button">Ir para o pagamento</button>
                                </a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
$_SESSION['total'] = $total;
include_once 'fundo.php';
?>