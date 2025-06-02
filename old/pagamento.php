<?php include_once 'topo.php';?>
<main class="page payment-page">
        <section class="clean-block payment-form dark" style="padding:0;">
            <div class="container" style="margin:20px auto 0px auto;margin-top:0px;">
                <div class="block-heading" style="padding:48px;margin-bottom:20px;padding-top:30px;padding-bottom:30px;padding-right:0px;padding-left:0px;">
                    <h2 class="text-center text-info">Formas de pagamento</h2>
                    <p>Escolha como quer pagar a sua compra</p>
                </div>
                <form action="vendacreate.php?">
                    <div class="products">
                        <h3 class="title">Seus produtos</h3>

<?php
include_once 'DAO.php';

foreach ($_SESSION['idvendaprod'] as $id){
    try {
    $stmt = $conn->prepare("SELECT * FROM Produto WHERE idproduto=".$id."");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "<div class='item'>
            <span class='price'>R$".$result['valor']."</span>
                <p class='item-name'>".$result['nome']."</p>
            </div>";
} catch (Exception $ex) {
    echo "Não foi possível consultar: " . $ex->getMessage();
}
}
?>
<!--FOREACH A SESSION AQUI PRA OBTER OS DADOS DOS PRODUTOS E LISTAR-->
                        <div class="total">
                            <span>Total</span>
                            <span class="price">R$<?php echo $_SESSION['total']?></span>
                        </div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Escolha a forma de pagamento</h3>
                        <div class="form-row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select name="pagamento">
                                        <option value="boleto">Boleto</option>
                                        <option value="cartao">Cartão</option>
                                        <option value="ouro">Ouro</option>
                                        <option value="transferencia">Transferência</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    Selecione o número de parcelas:
                                    <select name="parcelas">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Pagar">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="clean-block payment-form dark" style="padding:0;"></section>
    </main>
<?php include_once 'fundo.php';?>