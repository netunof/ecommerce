<?php

session_start();
include_once 'DAO.php';
$cliente = $_SESSION['idcliente'];
//UM CLIENTE PODE TER MUITOS PRODUTOS EM UMA VENDA
$produto = $_SESSION['idvendaprod'];
$valor = $_SESSION['total'];
$parcela = $_GET['parcelas'];
$tipo = $_GET['pagamento'];

try {

    $stmt = $conn->prepare("INSERT INTO Pagamento (tipo, parcela, valor)
            VALUES (:tipo, :parcela, :valor);");
    $stmt->bindParam(":tipo", $tipo);
    $stmt->bindParam(":parcela", $parcela);
    $stmt->bindParam(":valor", $valor);
    $stmt->execute();
    $stmt = null;
    //pega o ID de pagamento e joga dentro de fkpagamento
    $pagamento = $conn->lastInsertId();
    
    $stmt = $conn->prepare("INSERT INTO Compra (fkcliente, fkpagamento)
            VALUES (:fkcliente, :fkpagamento);");
    $stmt->bindParam(":fkcliente", $cliente);
    $stmt->bindParam(":fkpagamento", $pagamento);
    $stmt->execute();
    $stmt = null;
    //pega o ID de compra e joga em idcompra
    $compra = $conn->lastInsertId();
    
    foreach ($produto as $indice) {
        $stmt = $conn->prepare("INSERT INTO Carrinho (idcompra, idproduto)
            VALUES (:idcompra, :idproduto);");
        $stmt->bindParam(":idcompra", $compra);
        $stmt->bindParam(":idproduto", $indice);
        $stmt->execute();
        $stmt = null;
    }
    
    echo "<script>alert('AGRADECEMOS A PREFERÊNCIA'); window.location.href='fim.php'</script>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}