<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\{ProdutoController, CategoriaController, MarcaController, ProdutoFotoController, HomeController};

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get action from URL with default
$action = $_GET['action'] ?? 'home';

try {
    // Route requests
    switch ($action) {
        // Home route
        case 'home':
            $controller = new HomeController();
            $controller->home();
            break;

        // Produto routes
        case 'produto-index':
            $controller = new ProdutoController();
            $controller->index();
            break;
        case 'produto-show':
            if (!isset($_GET['id'])) {
                throw new Exception("ID do produto não especificado");
            }
            $controller = new ProdutoController();
            $controller->show($_GET['id']);
            break;
        case 'produto-create':
            $controller = new ProdutoController();
            $controller->create();
            break;
        case 'produto-store':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new ProdutoController();
            $controller->store();
            break;
        case 'produto-edit':
            if (!isset($_GET['id'])) {
                throw new Exception("ID do produto não especificado");
            }
            $controller = new ProdutoController();
            $controller->edit($_GET['id']);
            break;
        case 'produto-update':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new ProdutoController();
            $controller->update();
            break;
        case 'produto-delete':
            if (!isset($_GET['id'])) {
                throw new Exception("ID do produto não especificado");
            }
            $controller = new ProdutoController();
            $controller->delete($_GET['id']);
            break;

        // Marca routes
        case 'marca-index':
            $controller = new MarcaController();
            $controller->index();
            break;
        case 'marca-show':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da marca não especificado");
            }
            $controller = new MarcaController();
            $controller->show($_GET['id']);
            break;
        case 'marca-create':
            $controller = new MarcaController();
            $controller->create();
            break;
        case 'marca-store':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new MarcaController();
            $controller->store();
            break;
        case 'marca-edit':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da marca não especificado");
            }
            $controller = new MarcaController();
            $controller->edit($_GET['id']);
            break;
        case 'marca-update':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new MarcaController();
            $controller->update();
            break;
        case 'marca-delete':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da marca não especificado");
            }
            $controller = new MarcaController();
            $controller->delete($_GET['id']);
            break;

        // Categoria routes
        case 'categoria-index':
            $controller = new CategoriaController();
            $controller->index();
            break;
        case 'categoria-show':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da categoria não especificado");
            }
            $controller = new CategoriaController();
            $controller->show($_GET['id']);
            break;
        case 'categoria-create':
            $controller = new CategoriaController();
            $controller->create();
            break;
        case 'categoria-store':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new CategoriaController();
            $controller->store();
            break;
        case 'categoria-edit':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da categoria não especificado");
            }
            $controller = new CategoriaController();
            $controller->edit($_GET['id']);
            break;
        case 'categoria-update':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método não permitido");
            }
            $controller = new CategoriaController();
            $controller->update();
            break;
        case 'categoria-delete':
            if (!isset($_GET['id'])) {
                throw new Exception("ID da categoria não especificado");
            }
            $controller = new CategoriaController();
            $controller->delete($_GET['id']);
            break;

        // 404 - Not Found
        default:
            http_response_code(404);
            echo "<h1>Página não encontrada</h1>";
            echo "<p>A página que você está procurando não existe.</p>";
            echo "<a href='/public/index.php'>Voltar para a página inicial</a>";
            break;
    }
} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo "<h1>Ocorreu um erro</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<a href='/public/index.php'>Voltar para a página inicial</a>";
    
    // Log the error for debugging
    error_log($e->getMessage());
}
?>