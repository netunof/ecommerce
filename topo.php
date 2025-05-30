<?php session_start() ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digicommerce</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    </head>

    <body>
        <header style="width:auto;">
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="height:100px;padding:0px;width:auto;">
                <div class="container">
                    <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" style="width:300px;"></a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navcol-1" style="width:auto;margin-left:0px;padding:0px;padding-left:0px;">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation" style="width:80px;margin-left:40px;">
                                <a class="nav-link text-dark" href="clientelogin.php" style="color:rgb(0,0,0);margin-left:0px;width:auto;padding-top:8px;padding-right:0px;padding-left:0px;">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" href="carrinho.php" style="color:rgb(0,0,0);margin-left:0px;width:auto;padding-right:0px;padding-left:0px;">Meu carrinho</a>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" action="index.php" style="margin-right:0px;">
                            <div class="form-group" style="margin-left:40px;margin-right:0px;padding-left:0px;">
                                <label for="search-field"><i class="fa fa-search"></i></label>
                                <input class="form-control search-field" type="search" name="pesquisa" placeholder="o que você precisa?" id="search-field" style="padding-left:8px;padding-right:0px;">
                                <input type="submit" value="Busca" class="btn btn-light action-button">
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <!--colocar dentro de alguma classe bonitinha-->
            <?php
            if (isset($_SESSION['admin'])) {
                echo "BEM VINDO DEUS. <a href=logoff.php>Sair da sessão</a>";
            } else if (isset($_SESSION['email'])) {
                echo "você está logado como " . $_SESSION['nome'] . "<br><a href=logoff.php>Sair da sessão</a>";
            }
            ?>
        </header>