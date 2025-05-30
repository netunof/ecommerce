<?php
require_once "app/models/ProdutoModel.php";
class ProdutoController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Produto();
    }
    
    public function index() {
        $products = $this->productModel->getAll();
        require_once 'app/views/products/index.php';
    }
    
    public function show($id) {
        $product = $this->productModel->find($id);
        if ($product) {
            require_once 'app/views/products/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'produto_nome' => $_POST['produto_nome'],
                'produto_descricao' => $_POST['produto_descricao'],
                'produto_preco' => $_POST['produto_preco'],
                'produto_estoque' => $_POST['produto_estoque']
            ];
            
            if ($this->productModel->create($data)) {
                header('Location: /products');
            } else {
                die('Erro ao criar');
            }
        } else {
            require_once 'app/views/products/create.php';
        }
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'produto_nome' => $_POST['produto_nome'],
                'produto_descricao' => $_POST['produto_descricao'],
                'produto_preco' => $_POST['produto_preco'],
                'produto_estoque' => $_POST['produto_estoque']
            ];
            
            if ($this->productModel->update($id, $data)) {
                header('Location: /products/' . $id);
            } else {
                die('Erro ao modificar');
            }
        } else {
            $product = $this->productModel->find($id);
            if ($product) {
                require_once 'app/views/products/edit.php';
            } else {
                $this->notFound();
            }
        }
    }
    
    public function delete($id) {
        if ($this->productModel->delete($id)) {
            header('Location: /products');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Produto não encontrado";
        exit();
    }
}