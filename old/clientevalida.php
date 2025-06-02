<?php

session_start();

$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

include_once 'DAO.php';

if (isset($_SESSION['apoteose'])) {
    unset($_SESSION['apoteose']);
}
try {
    $stmt = $conn->prepare("SELECT * FROM Cliente WHERE email='$email' AND senha='$senha'");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        $_SESSION['idcliente'] = $result['idcliente'];
        $_SESSION['nome'] = $result['nome'];
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['logado'] = true;
        echo "<script>alert('Bem vindo usuário'); window.location.href='index.php'</script>";
    } else {
        unset($_SESSION['clienteid']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['logado']);
        echo "<script>alert('Login e/ou senha inválidos, tente novamente'); window.location.href='login.php'</script>";
    }
} catch (Exception $ex) {
    echo "Não foi possível consultar: " . $ex->getMessage();
}

$conn = null;
