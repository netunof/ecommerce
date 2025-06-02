<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['senha'])){
    echo "<script>window.location.href='pagamento.php'</script>";
} else {
    echo "<script>alert('Faça seu login primeiro!'); window.location.href='clientelogin.php'</script>";
}