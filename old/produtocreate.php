<?php

include_once 'DAO.php';
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
    $stmt = $conn->prepare("INSERT INTO Produto (nome, valor, fotoproduto, fotoproduto1, fotoproduto2, descricao, descdetalhada, titulo1, feature1, fotofeature1, titulo2, feature2, fotofeature2, categoria, marca, specs) "
            . "values (:nomeproduto, :valor, :fotoproduto, :fotoproduto1, :fotoproduto2, :descricao, :descdetalhada, :titulof1, :feature1, :fotofeature1, :titulof2, :feature2, :fotofeature2, :categoria, :marca, :specsproduto)");
    
    $stmt->bindParam(":nomeproduto", $nome);
    $stmt->bindParam(":valor", $preco);
    $stmt->bindParam(":fotoproduto", $foto);
    $stmt->bindParam(":fotoproduto1", $foto1);
    $stmt->bindParam(":fotoproduto2", $foto2);
    $stmt->bindParam(":descricao", $desc);
    $stmt->bindParam(":descdetalhada", $detalhada);
    $stmt->bindParam(":titulof1", $titulo1);
    $stmt->bindParam(":feature1", $feature1);
    $stmt->bindParam(":fotofeature1", $fotofeature1);
    $stmt->bindParam(":titulof2", $titulo2);
    $stmt->bindParam(":feature2", $feature2);
    $stmt->bindParam(":fotofeature2", $fotofeature2);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":marca", $marca);
    $stmt->bindParam(":specsproduto", $spec);
    $stmt->execute();

    echo "<script>alert('produto cadastrado com sucesso'); window.location.href='cadproduto.php'</script>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>