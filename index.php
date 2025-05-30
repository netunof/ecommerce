<?php
require_once 'config/database.php';
require_once 'app/controllers/MarcaController.php';
require_once 'app/controllers/ModeloController.php';
require_once 'app/controllers/ProdutoController.php';

$request = $_SERVER['REQUEST_URI'];
$produtoController = new ProdutoController();
$marcaController = new MarcaController();
$modeloController = new ModeloController();

switch ($request) {
#MODELOS
    case '':
    case '/':
        $modeloController->index();
        break;
        
    case preg_match('/^\/modelo\/create\/?$/', $request) ? true : false:
        $modeloController->create();
        break;
        
    case preg_match('/^\/modelos\/(\d+)\/?$/', $request, $matches) ? true : false:
        $modeloController->show($matches[1]);
        break;
        
    case preg_match('/^\/modelos\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $modeloController->edit($matches[1]);
        break;
        
    case preg_match('/^\/modelos\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $modeloController->delete($matches[1]);
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