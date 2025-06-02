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
        require_once 'app/views/categoria/create.php';
    }

    public function store() {
        $data = [
                'categoria_nome' => $_POST['categoria_nome']
            ];
        if ($this->categoriaModel->create($data)) {
            header('Location: /');
        } else {
            die('Erro ao criar');
        }
    }
    
    public function edit() {
        $id = $_GET['categoria_id'];
        $categoria = $this->categoriaModel->find($id);
        require_once 'app/views/categoria/edit.php';
    }

    public function update() {
        $id = $_POST['categoria_id'];
        $nome = $_POST['categoria_nome'];
        if($this->categoriaModel->update($id, $nome)){
            header('Location: /');
        } else {
            die('Erro ao atualizar');
        }
    }
    
    public function delete($id) {
        if ($this->categoriaModel->delete($id)) {
            header('Location: /');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Categoria não encontrada";
        exit();
    }
}