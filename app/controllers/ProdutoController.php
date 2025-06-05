<?php
require_once "app/models/ProdutoModel.php";
class ProdutoController {
    private $produtoModel;
    
    public function __construct() {
        $this->produtoModel = new Produto();
    }
    
    public function index() {
        $produtos = $this->produtoModel->getAll();
        /*[':produto_nome' => 'produto_nome',
        ':produto_marca' => 'produto_marca', ':produto_modelo' => 'produto_modelo',
        ':preco_max' => 'preco_max', ':preco_min ' => 'preco_min']*/
        require_once 'app/views/produto/index.php';
    }
    
    public function show($id) {
        $produto = $this->produtoModel->find($id);
        if ($produto) {
            require_once 'app/views/produto/show.php';
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
            
            if ($this->produtoModel->create($data)) {
                header('Location: /produto');
            } else {
                die('Erro ao criar');
            }
        } else {
            require_once 'app/views/produto/create.php';
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
            
            if ($this->produtoModel->update($id, $data)) {
                header('Location: /produto/' . $id);
            } else {
                die('Erro ao modificar');
            }
        } else {
            $produto = $this->produtoModel->find($id);
            if ($produto) {
                require_once 'app/views/produto/edit.php';
            } else {
                $this->notFound();
            }
        }
    }
    
    public function delete($id) {
        if ($this->produtoModel->delete($id)) {
            header('Location: /produto');
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