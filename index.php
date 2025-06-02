<?php
require_once 'config/database.php';
require_once 'app/controllers/MarcaController.php';
require_once 'app/controllers/CategoriaController.php';
require_once 'app/controllers/ProdutoController.php';

$request = $_SERVER['REQUEST_URI'];
$produtoController = new ProdutoController();
$marcaController = new MarcaController();
$categoriaController = new CategoriaController();

switch ($request) {
#MODELOS
    case '':
    case '/':
        $categoriaController->index();
        break;
        
    case preg_match('/^\/categoria\/create\/?$/', $request) ? true : false:
        $categoriaController->create();
        break;
        
    case preg_match('/^\/categorias\/(\d+)\/?$/', $request, $matches) ? true : false:
        $categoriaController->show($matches[1]);
        break;
        
    case preg_match('/^\/categorias\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $categoriaController->edit($matches[1]);
        break;
        
    case preg_match('/^\/categorias\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $categoriaController->delete($matches[1]);
        break;
#PRODUTOS
    case '/produtos':
    case '/produtos/':
        $produtoController->index();
        break;
        
    case preg_match('/^\/produtos\/create\/?$/', $request) ? true : false:
        $produtoController->create();
        break;
        
    case preg_match('/^\/produtos\/(\d+)\/?$/', $request, $matches) ? true : false:
        $produtoController->show($matches[1]);
        break;
        
    case preg_match('/^\/produtos\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $produtoController->edit($matches[1]);
        break;
        
    case preg_match('/^\/produtos\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $produtoController->delete($matches[1]);
        break;
    
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}