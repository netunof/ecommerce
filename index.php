<?php
require_once 'vendor/autoload.php';

use App\Controllers\{ProdutoController, CategoriaController, MarcaController, ProdutoFotoController, HomeController};

$request = $_SERVER['REQUEST_URI'];
$produtoController = new ProdutoController();
$produtoFotoController = new ProdutoFotoController();
$marcaController = new MarcaController();
$categoriaController = new CategoriaController();
$homeController = new HomeController();

switch ($request) {
    case '/':
        $filters = [
            'produto_nome' => $_GET['search'] ?? '',
            'marca_fk' => $_GET['marca'] ?? 0,
            'categoria_fk' => $_GET['categoria'] ?? 0,
            'preco_min' => $_GET['min_price'] ?? 0,
            'preco_max' => $_GET['max_price'] ?? PHP_FLOAT_MAX
        ];
        $homeController->home($filters);
        break;
    case '/admin':
        require_once 'app/views/admin.php';
        break;
#CATEGORIAS
    case '/categorias/':
    case '/categorias':
        $categoriaController->index();
        break;
        
    case preg_match('/^\/categoria\/create\/?$/', $request) ? true : false:
        $categoriaController->create();
        break;
    
    case preg_match('/^\/categoria\/store\/?$/', $request) ? true : false:
        $categoriaController->store();
        break;
        
    case preg_match('/^\/categoria\/(\d+)\/?$/', $request, $matches) ? true : false:
        $categoriaController->show($matches[1]);
        break;
        
    case preg_match('/^\/categoria\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $categoriaController->edit($matches[1]);
        break;
    
    case preg_match('/^\/categoria\/(\d+)\/update\/?$/', $request, $matches) ? true : false:
        $categoriaController->update();
        break;
        
    case preg_match('/^\/categoria\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $categoriaController->delete($matches[1]);
        break;
#MARCAS
    case '/marcas/':
    case '/marcas':
        $marcaController->index();
        break;
        
    case preg_match('/^\/marca\/create\/?$/', $request) ? true : false:
        $marcaController->create();
        break;
    
    case preg_match('/^\/marca\/store\/?$/', $request) ? true : false:
        $marcaController->store();
        break;
        
    case preg_match('/^\/marca\/(\d+)\/?$/', $request, $matches) ? true : false:
        $marcaController->show($matches[1]);
        break;
        
    case preg_match('/^\/marca\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $marcaController->edit($matches[1]);
        break;
    
    case preg_match('/^\/marca\/(\d+)\/update\/?$/', $request, $matches) ? true : false:
        $marcaController->update();
        break;
    
    case preg_match('/^\/marca\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $marcaController->delete($matches[1]);
        break;
#PRODUTOS
    case '/produtos':
    case '/produtos/':
        $produtoController->index();
        break;
        
    case preg_match('/^\/produto\/create\/?$/', $request) ? true : false:
        $produtoController->create();
        break;
    
    case preg_match('/^\/produto\/store\/?$/', $request) ? true : false:
        $produtoController->store();
        break;
        
    case preg_match('/^\/produto\/(\d+)\/?$/', $request, $matches) ? true : false:
        $produtoController->show($matches[1]);
        break;
        
    case preg_match('/^\/produto\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $produtoController->edit($matches[1]);
        break;

    case preg_match('/^\/produto\/(\d+)\/update\/?$/', $request, $matches) ? true : false:
        $produtoController->update();
        break;
        
    case preg_match('/^\/produto\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $produtoController->delete($matches[1]);
        break;
    
    case preg_match('/^\/produtoFoto\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $produtoFotoController->delete($matches[1]);
        break;

    
    #CLIENTES
    case '/clientes':
    case '/clientes/':
        $clienteController->index();
        break;
        
    case preg_match('/^\/cliente\/create\/?$/', $request) ? true : false:
        $clienteController->create();
        break;
    
    case preg_match('/^\/cliente\/store\/?$/', $request) ? true : false:
        $clienteController->store();
        break;
        
    case preg_match('/^\/cliente\/(\d+)\/?$/', $request, $matches) ? true : false:
        $clienteController->show($matches[1]);
        break;
        
    case preg_match('/^\/cliente\/(\d+)\/edit\/?$/', $request, $matches) ? true : false:
        $clienteController->edit($matches[1]);
        break;

    case preg_match('/^\/cliente\/(\d+)\/update\/?$/', $request, $matches) ? true : false:
        $clienteController->update();
        break;
        
    case preg_match('/^\/cliente\/(\d+)\/delete\/?$/', $request, $matches) ? true : false:
        $clienteController->delete($matches[1]);
        break;
    
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}

/*
Array ( [produto_fotos] => Array ( 
[name] => Array ( [0] => primeira.jpg [1] => segunda.jpg ) 
[full_path] => Array ( [0] => primeira.jpg [1] => segunda.jpg ) 
[type] => Array ( [0] => image/jpeg [1] => image/jpeg ) 
[tmp_name] => Array ( [0] => /private/var/folders/wb/pr5zph914m36_135w0n2m0740000gn/T/phpuh1f3a3rir57eoa7EDa [1] => /private/var/folders/wb/pr5zph914m36_135w0n2m0740000gn/T/phpusgt5dl6i1gj5YAClom ) 
[error] => Array ( [0] => 0 [1] => 0 ) 
[size] => Array ( [0] => 25929 [1] => 11424 ) ) )
 */