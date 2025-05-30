<?php

include_once 'DAO.php';
$nome = filter_input(INPUT_GET, 'nome');
$email = filter_input(INPUT_GET, 'email');
$sexo = filter_input(INPUT_GET, 'sexo');
$telfixo = filter_input(INPUT_GET, 'fixo');
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
    $stmt = $conn->prepare("INSERT INTO Cliente (nome, email, sexo, fixo, celular, cpf, rg, nascimento, senha)
            VALUES (:nome, :email, :sexo, :fixo, :celular, :cpf, :rg, :nascimento, :senha);");
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->bindParam(":fixo", $telfixo);
    $stmt->bindParam(":celular", $celular);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->bindParam(":rg", $rg);
    $stmt->bindParam(":nascimento", $nascimento);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();
    $pessoa = $conn->lastInsertId();
    $stmt=null;
    
    $stmt = $conn->prepare("INSERT INTO Endereco (cep, logradouro, bairro, cidade, uf, numero)
            VALUES (:cep, :logradouro, :bairro, :cidade, :uf, :numero);");
    $stmt->bindParam(":cep", $cep);
    $stmt->bindParam(":logradouro", $logradouro);
    $stmt->bindParam(":bairro", $bairro);
    $stmt->bindParam(":cidade", $cidade);
    $stmt->bindParam(":uf", $uf);
    $stmt->bindParam(":numero", $numero);
    $stmt->execute();
    $local = $conn->lastInsertId();
    $stmt=null;
    
    $stmt = $conn->prepare("INSERT INTO Moradia (idcliente, idendereco)
            VALUES (:idcliente, :idendereco);");
    $stmt->bindParam(":idcliente", $pessoa);
    $stmt->bindParam(":idendereco", $local);
    $stmt->execute();
    $stmt=null;
    echo "<script>alert('cliente cadastrado com sucesso'); window.location.href='index.php';</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}/*
try {
    $stmt1 = $conn->prepare("BEGIN;
        INSERT INTO Endereco (cep, logradouro, bairro, cidade, uf, numero)
            VALUES (:cep, :logradouro, :bairro, :cidade, :uf, :numero);
        INSERT INTO Moradia (idendereco)
            VALUES (LAST_INSERT_ID());
        COMMIT;");
    $stmt1->bindParam(":cep", $cep);
    $stmt1->bindParam(":logradouro", $logradouro);
    $stmt1->bindParam(":bairro", $bairro);
    $stmt1->bindParam(":cidade", $cidade);
    $stmt1->bindParam(":uf", $uf);
    $stmt1->bindParam(":numero", $numero);
    $stmt1->execute();
    
    echo "cliente cadastrado com sucesso";
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}*/
$conn = null;
?>