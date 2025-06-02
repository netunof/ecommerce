<?php
include_once 'topo.php';
include_once 'DAO.php';

try {
    $stmt = $conn->prepare("SELECT co.idcompra, cl.idcliente, cl.nome AS Cliente, pr.nome AS Itens, pa.tipo AS 'Forma de pagamento', pa.parcela AS Parcelas, pa.valor
            FROM compra AS co
            INNER JOIN cliente AS cl ON co.fkcliente = cl.idcliente
            INNER JOIN pagamento AS pa ON pa.idpagamento = co.fkpagamento
            INNER JOIN carrinho AS ca ON ca.idcompra = co.idcompra
            INNER JOIN produto AS pr ON pr.idproduto = ca.idproduto");
    $stmt->execute();
    ?>
<div class="container text-center">
    <div class="table table-responsive">
        <table class="table-striped">
<?php
    foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $result) {
        echo "
            <tr>
                <td>".$result['idcompra']."</td>
                <td>".$result['idcliente']."</td>
                <td>".$result['Cliente']."</td>
                <td>".$result['Itens']."</td>
                <td>".$result['Forma de pagamento']."</td>
                <td>".$result['Parcelas']."</td>
                <td>".$result['valor']."</td>
            </tr>";
    }
} catch (Exception $ex) {
    echo "Não foi possível consultar: " . $ex->getMessage();
}
?>
        </table>
    </div>
</div>
<?php
include_once 'fundo.php';
?>
