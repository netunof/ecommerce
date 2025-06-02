<?php

session_start();

$admin = filter_input(INPUT_POST, 'admin');
$poder = filter_input(INPUT_POST, 'admpass');
if (isset($_SESSION['logado'])) {
    unset($_SESSION['logado']);
}
if ($admin == 'deus' && $poder == 'adminmalvadao') {
    $_SESSION['admin'] = $admin;
    $_SESSION['admpass'] = $poder;
    $_SESSION['apoteose'] = true;
    echo "<script>alert('LOUVADO SEJA!!!'); window.location.href='ferramentas.php'</script>";
} else {
    unset($_SESSION['admin']);
    unset($_SESSION['admpass']);
    unset($_SESSION['apoteose']);
    echo "<script>alert('VOCÊ NÃO É DEUS, VAZA!!!'); window.location.href='index.php'</script>";
}