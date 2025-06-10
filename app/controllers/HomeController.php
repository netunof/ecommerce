<?php
namespace App\Controllers;

use App\Models\{CategoriaModel, MarcaModel, ProdutoModel};

class HomeController {
    private $categoriaModel;
    private $marcaModel;
    private $produtoModel;
    
    public function __construct() {
        $this->categoriaModel = new CategoriaModel();
        $this->marcaModel = new MarcaModel();
        $this->produtoModel = new ProdutoModel();
    }
    public function home() {
        $data = [
            'categorias' => $this->categoriaModel->getAll(),
            'marcas' => $this->marcaModel->getAll(),
            'produtos' => $this->produtoModel->getAll()
        ];
        require_once 'app/views/home.php';
    }
    private function notFound() {
        http_response_code(404);
        echo "404 - Categoria não encontrada";
        exit();
    }
}