<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digicommerce - Sua Loja Digital</title>
    <meta name="description" content="Digicommerce - A melhor experiência em compras online">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="/public/img/favicon.ico" type="image/x-icon">
    
    <style>
        /* CSS mínimo necessário apenas para ajustes específicos */
        .logo-container {
            max-width: 180px;
        }
        .search-box {
            max-width: 500px;
        }
    </style>
</head>

<body>
    <!-- TOPO -->
    <div class="bg-light border-bottom py-2 small">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 mb-2 mb-md-0">
                <span class="text-nowrap"><i class="fas fa-phone-alt me-1"></i> (11) 1234-5678</span>
                <span class="text-nowrap"><i class="fas fa-envelope me-1"></i> contato@digicommerce.com.br</span>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="/rastreio" class="text-decoration-none text-dark text-nowrap"><i class="fas fa-truck me-1"></i> Rastrear Pedido</a>
                <a href="/atendimento" class="text-decoration-none text-dark text-nowrap"><i class="fas fa-headset me-1"></i> Atendimento</a>
            </div>
        </div>
    </div>

    <header class="sticky-top bg-white shadow-sm">
        <!-- PESQUISA -->
        <div class="container py-3">
            <div class="row align-items-center g-3">
                <div class="col-md-3 text-center text-md-start">
                    <a href="/">
                        <img src="/public/img/logo.png" alt="Digicommerce Logo" class="img-fluid logo-container">
                    </a>
                </div>
                
                <div class="col-md-6">
                    <form class="search-box mx-auto" action="/" method="get">
                        <div class="input-group">
                            <input class="form-control border-end-0" type="search" name="produto_nome" placeholder="O que você procura?" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-3 text-center text-md-end">
                    <div class="d-flex justify-content-center justify-content-md-end align-items-center gap-3">
                        <a href="<?= isset($_SESSION['cliente_email']) ? '/perfil' : '/login' ?>" class="text-dark text-decoration-none">
                            <i class="fas fa-user me-1"></i> <?= isset($_SESSION['cliente_email']) ? $_SESSION['cliente_nome'] : 'Entrar' ?>
                        </a>
                        <a href="/carrinho" class="text-dark text-decoration-none position-relative">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                <?= $_SESSION['cart_count'] ?? 0 ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- NAVEGAÇÃO -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-top">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/produtos">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ofertas">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/marcas">Marcas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contato">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- BARRA DE STATUS -->
        <?php if (isset($_SESSION['admin']) || isset($_SESSION['email'])): ?>
        <div class="bg-light py-2 border-bottom small">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-2 mb-md-0">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <span class="badge bg-danger me-2">ADMIN</span>
                    <?php endif; ?>
                    <span>Olá, <strong><?= $_SESSION['nome'] ?? 'Administrador' ?></strong>!</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="/pedidos" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-box me-1"></i> Meus Pedidos
                    </a>
                    <a href="logoff.php" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-1"></i> Sair
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </header>
    
    <main class="container my-4">