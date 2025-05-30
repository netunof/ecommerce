<?php
require_once "../app/models/MarcaModel.php";
class MarcaController {
    private $marcaModel;
    
    public function __construct() {
        $this->marcaModel = new Marca();
    }
    
    public function index() {
        $marcas = $this->marcaModel->getAll();
        require_once '../app/views/marca/index.php';
    }
    
    public function show($id) {
        $marca = $this->marcaModel->find($id);
        if ($marca) {
            require_once '../app/views/marca/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'marca_nome' => $_POST['marca_nome']
            ];
            
            if ($this->marcaModel->create($data)) {
                header('Location: /marca');
            } else {
                die('Erro ao criar');
            }
        } else {
            require_once '../app/views/marca/create.php';
        }
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'marca_nome' => $_POST['marca_nome']
            ];
            
            if ($this->marcaModel->update($id, $data)) {
                header('Location: /marca/' . $id);
            } else {
                die('Erro ao modificar');
            }
        } else {
            $marca = $this->marcaModel->find($id);
            if ($marca) {
                require_once '../app/views/marca/edit.php';
            } else {
                $this->notFound();
            }
        }
    }
    
    public function delete($id) {
        if ($this->marcaModel->delete($id)) {
            header('Location: /marca');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Marca não encontrada";
        exit();
    }
}