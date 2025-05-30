<?php
require_once "app/models/ModeloModel.php";
class ModeloController {
    private $modeloModel;
    
    public function __construct() {
        $this->modeloModel = new Modelo();
    }
    
    public function index() {
        $modelos = $this->modeloModel->getAll();
        require_once 'app/views/modelo/index.php';
    }
    
    public function show($id) {
        $modelo = $this->modeloModel->find($id);
        if ($modelo) {
            require_once 'app/views/modelo/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'modelo_nome' => $_POST['modelo_nome']
            ];
            
            if ($this->modeloModel->create($data)) {
                header('Location: /modelo');
            } else {
                die('Erro ao criar');
            }
        } else {
            require_once 'app/views/modelo/create.php';
        }
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'modelo_nome' => $_POST['modelo_nome']
            ];
            
            if ($this->modeloModel->update($id, $data)) {
                header('Location: /modelo/' . $id);
            } else {
                die('Erro ao modificar');
            }
        } else {
            $modelo = $this->modeloModel->find($id);
            if ($modelo) {
                require_once 'app/views/modelo/edit.php';
            } else {
                $this->notFound();
            }
        }
    }
    
    public function delete($id) {
        if ($this->modeloModel->delete($id)) {
            header('Location: /modelo');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Modelo não encontrado``";
        exit();
    }
}