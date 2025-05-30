<?php
include_once 'topo.php';
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'deus' && $_SESSION['admpass'] == 'adminmalvadao') {
    echo "<div style='padding:0px 0px;margin-top:0px;width:500px;margin-left:auto;margin-right:auto;'>
        <a href='clientelista.php'>
            <button class='btn btn-primary' type='button' style='width:500px;height:100px;'>Gerenciar clientes</button>
        </a>
        <a href='produtolista.php'>
            <button class='btn btn-primary' type='button' style='width:500px;height:100px;'>Modificar produtos</button>
        </a>
    </div>";
} else {
    echo "<div style='padding:0px 0px;margin-top:0px;width:500px;margin-left:auto;margin-right:auto;'>
        <a href='admin.php'>
            <button class='btn btn-primary' type='button' style='width:500px;height:100px;'>Você não é deus</button>
        </a>
        <a href='https://www.xvideos.com'>
            <button class='btn btn-primary' type='button' style='width:500px;height:100px;'>Cadê a apoteose?</button>
        </a>
    </div>";
}
include_once 'fundo.php';
?>