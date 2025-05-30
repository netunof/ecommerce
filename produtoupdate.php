<?php

include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
$nome = filter_input(INPUT_GET, 'nomeproduto');
$preco = filter_input(INPUT_GET, 'precoproduto');
$foto = filter_input(INPUT_GET, 'fotoproduto');
$foto1 = filter_input(INPUT_GET, 'fotoproduto1');
$foto2 = filter_input(INPUT_GET, 'fotoproduto2');
$desc = filter_input(INPUT_GET, 'descproduto');
$detalhada = filter_input(INPUT_GET, 'detalhada');
$titulo1 = filter_input(INPUT_GET, 'titulofeature1');
$feature1 = filter_input(INPUT_GET, 'feature1');
$fotofeature1 = filter_input(INPUT_GET, 'fotofeature1');
$titulo2 = filter_input(INPUT_GET, 'titulofeature2');
$feature2 = filter_input(INPUT_GET, 'feature2');
$fotofeature2 = filter_input(INPUT_GET, 'fotofeature2');
$categoria = filter_input(INPUT_GET, 'categoria');
$marca = filter_input(INPUT_GET, 'marca');
$spec = filter_input(INPUT_GET, 'specsproduto');

try {
    $stmt = $conn->prepare("UPDATE Produto 
        SET nome = :nomeproduto, valor = :valor, fotoproduto = :fotoproduto, fotoproduto1 = :fotoproduto1, 
        fotoproduto2 = :fotoproduto2, descricao = :descricao, descdetalhada = :descdetalhada, titulo1 = :titulo1, 
        feature1 = :feature1, fotofeature1 = :fotofeature1, titulo2 = :titulo2, feature2 = :feature2, fotofeature2 = :fotofeature2, 
        categoria = :categoria, marca = :marca, specs = :specs 
        WHERE idproduto = :id");
    
    $stmt->bindParam(":nomeproduto", $nome);
    $stmt->bindParam(":valor", $preco);
    $stmt->bindParam(":fotoproduto", $foto);
    $stmt->bindParam(":fotoproduto1", $foto1);
    $stmt->bindParam(":fotoproduto2", $foto2);
    $stmt->bindParam(":descricao", $desc);
    $stmt->bindParam(":descdetalhada", $detalhada);
    $stmt->bindParam(":titulo1", $titulo1);
    $stmt->bindParam(":feature1", $feature1);
    $stmt->bindParam(":fotofeature1", $fotofeature1);
    $stmt->bindParam(":titulo2", $titulo2);
    $stmt->bindParam(":feature2", $feature2);
    $stmt->bindParam(":fotofeature2", $fotofeature2);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":marca", $marca);
    $stmt->bindParam(":specs", $spec);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    echo "<script>alert('produto atualizado com sucesso'); window.location.href='produto.php?id=$id'</script>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>