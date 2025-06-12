<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digicommerce - Sua Loja Digital</title>
    <meta name="description" content="Digicommerce - A melhor experiência em compras online">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="/public/assets/img/favicon.ico" type="image/x-icon">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>

<body>
    <header class="sticky-top bg-white shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand-container">
                    <a class="navbar-brand" href="/">
                        <img src="/public/assets/img/logo.png" alt="Digicommerce Logo" class="img-fluid logo" width="300">
                    </a>
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/carrinho">
                                <i class="fas fa-shopping-cart me-1"></i> Meu Carrinho
                                <span class="badge bg-primary rounded-pill"><?= $_SESSION['cart_count'] ?? 0 ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= isset($_SESSION['email']) ? 'perfil.php' : 'login.php' ?>">
                                <i class="fas fa-user me-1"></i> <?= isset($_SESSION['email']) ? 'Minha Conta' : 'Login' ?>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['admin']) || isset($_SESSION['email'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog me-1"></i> Menu
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (isset($_SESSION['admin'])): ?>
                                    <li><h6 class="dropdown-header">Administrativo</h6></li>
                                    <li><a class="dropdown-item" href="/categorias"><i class="fas fa-tags me-2"></i>Categorias</a></li>
                                    <li><a class="dropdown-item" href="/clientes"><i class="fas fa-users me-2"></i>Clientes</a></li>
                                    <li><a class="dropdown-item" href="/marcas"><i class="fas fa-trademark me-2"></i>Marcas</a></li>
                                    <li><a class="dropdown-item" href="/produtos"><i class="fas fa-box-open me-2"></i>Produtos</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item text-danger" href="logoff.php"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    
                    <form class="d-flex" role="search" action="/busca" method="get">
                        <div class="input-group">
                            <input class="form-control" type="search" name="q" placeholder="O que você procura?" aria-label="Search" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        
        <!-- User Status Bar -->
        <?php if (isset($_SESSION['admin']) || isset($_SESSION['email'])): ?>
        <div class="user-status-bar bg-light py-2 border-bottom">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <span class="badge bg-danger me-2">ADMIN</span>
                    <?php endif; ?>
                    <span>Olá, <strong><?= $_SESSION['nome'] ?? 'Administrador' ?></strong>!</span>
                </div>
                <a href="logoff.php" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-sign-out-alt me-1"></i> Sair
                </a>
            </div>
        </div>
        <?php endif; ?>
    </header>
    
    <main class="container my-4">