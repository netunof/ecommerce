<?php
include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
try {
    $stmt = $conn->prepare("DELETE FROM Cliente
        WHERE idcliente = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "<script>alert('cliente removido com sucesso'); window.location.href='clientelista.php'</script>";
} catch (Exception $ex) {
    echo "Error: " . $e->getMessage();
}
$conn = null;