<?php
require_once "app/models/CategoriaModel.php";
require_once "app/models/MarcaModel.php";
require_once "app/models/ProdutoModel.php";
class HomeController {
    private $categoriaModel;
    private $marcaModel;
    private $produtoModel;
    
    public function __construct() {
        $this->categoriaModel = new Categoria();
        $this->marcaModel = new Marca();
        $this->produtoModel = new Produto();
    }
    public function home() {
        $data = [
            'categorias' => $this->categoriaModel->getAll(),
            'marcas' => $this->marcaModel->getAll(),
            'produtos' => $this->produtoModel->asdf()
        ];
        require_once 'app/views/home.php';
    }
    private function notFound() {
        http_response_code(404);
        echo "404 - Categoria não encontrada";
        exit();
    }
}