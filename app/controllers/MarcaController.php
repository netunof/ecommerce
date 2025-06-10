<?php
namespace App\Controllers;

use app\Models\MarcaModel;
class MarcaController {
    private $marcaModel;
    
    public function __construct() {
        $this->marcaModel = new MarcaModel();
    }
    
    public function index() {
        $marcas = $this->marcaModel->getAll();
        require_once 'app/views/marca/index.php';
    }
    
    public function show($id) {
        $marca = $this->marcaModel->find($id);
        if ($marca) {
            require_once 'app/views/marca/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        require_once 'app/views/marca/create.php';
    }

    public function store() {
        $data = [
                'marca_nome' => $_POST['marca_nome']
            ];
        if ($this->marcaModel->create($data)) {
            header('Location: /marcas');
        } else {
            die('Erro ao criar');
        }
    }
    
    public function edit($id) {
        $marca = $this->marcaModel->find($id);
        require_once 'app/views/marca/edit.php';
    }

    public function update() {
        $id = $_POST['marca_id'];
        $nome = $_POST['marca_nome'];
        if($this->marcaModel->update($id, $nome)){
            header('Location: /marcas');
        } else {
            die('Erro ao atualizar');
        }
    }
    
    public function delete($id) {
        if ($this->marcaModel->delete($id)) {
            header('Location: /marcas');
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