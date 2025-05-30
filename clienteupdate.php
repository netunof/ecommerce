<?php

include_once 'DAO.php';
$id = filter_input(INPUT_GET, 'id');
$nome = filter_input(INPUT_GET, 'nome');
$email = filter_input(INPUT_GET, 'email');
$sexo = filter_input(INPUT_GET, 'sexo');
$fixo = filter_input(INPUT_GET, 'fixo');
$celular = filter_input(INPUT_GET, 'celular');
$cpf = filter_input(INPUT_GET, 'cpf');
$rg = filter_input(INPUT_GET, 'rg');
$nascimento = filter_input(INPUT_GET, 'nascimento');
$cep = filter_input(INPUT_GET, 'cep');
$logradouro = filter_input(INPUT_GET, 'logradouro');
$bairro = filter_input(INPUT_GET, 'bairro');
$cidade = filter_input(INPUT_GET, 'cidade');
$uf = filter_input(INPUT_GET, 'uf');
$numero = filter_input(INPUT_GET, 'numero');
$senha = filter_input(INPUT_GET, 'senha');

try {
    $stmt = $conn->prepare("UPDATE Cliente 
        SET nome = :nome, email = :email, sexo = :sexo, fixo = :fixo, celular = :celular, cpf = :cpf, rg = :rg, nascimento = :nascimento, 
        cep = :cep, logradouro = :logradouro, bairro = :bairro, cidade = :cidade, uf = :uf, numero = :numero, senha = :senha 
        WHERE idcliente = :id");
    
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->bindParam(":fixo", $fixo);
    $stmt->bindParam(":celular", $celular);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->bindParam(":rg", $rg);
    $stmt->bindParam(":nascimento", $nascimento);
    $stmt->bindParam(":cep", $cep);
    $stmt->bindParam(":logradouro", $logradouro);
    $stmt->bindParam(":bairro", $bairro);
    $stmt->bindParam(":cidade", $cidade);
    $stmt->bindParam(":uf", $uf);
    $stmt->bindParam(":numero", $numero);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    echo "<script>alert('cliente atualizado com sucesso'); window.location.href='clientelista.php'</script>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>