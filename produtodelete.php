<?php
include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
try {
    $stmt = $conn->prepare("DELETE FROM Produto
        WHERE idproduto = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "<script>alert('produto removido com sucesso'); window.location.href='produtolista.php'</script>";
} catch (Exception $ex) {
    echo "Error: " . $e->getMessage();
}
$conn = null;