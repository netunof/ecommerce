<?php
require_once "app/models/CategoriaModel.php";
class CategoriaController {
    private $categoriaModel;
    
    public function __construct() {
        $this->categoriaModel = new Categoria();
    }
    
    public function index() {
        $categorias = $this->categoriaModel->getAll();
        require_once 'app/views/categoria/index.php';
    }
    
    public function show($id) {
        $categoria = $this->categoriaModel->find($id);
        if ($categoria) {
            require_once 'app/views/categoria/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'categoria_nome' => $_POST['categoria_nome']
            ];
            
            if ($this->categoriaModel->create($data)) {
                header('Location: /categoria');
            } else {
                die('Erro ao criar');
            }
        } else {
            require_once 'app/views/categoria/create.php';
        }
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'categoria_nome' => $_POST['categoria_nome']
            ];
            
            if ($this->categoriaModel->update($id, $data)) {
                header('Location: /categoria/' . $id);
            } else {
                die('Erro ao modificar');
            }
        } else {
            $categoria = $this->categoriaModel->find($id);
            if ($categoria) {
                require_once 'app/views/categoria/edit.php';
            } else {
                $this->notFound();
            }
        }
    }
    
    public function delete($id) {
        if ($this->categoriaModel->delete($id)) {
            header('Location: /categoria');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Categoria não encontrado``";
        exit();
    }
}