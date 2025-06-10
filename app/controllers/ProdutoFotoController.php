<?php
namespace App\Controllers;

require_once "app/models/ProdutoFotoModel.php";
class ProdutoFotoController {
    private $produtoFotoModel;
    
    public function __construct() {
        $this->produtoFotoModel = new ProdutoFoto();
    }
    
    public function store($produtoId, $fotos) {
        if (!$fotos) {
            return false;
        }
        
        foreach ($fotos as $foto) {
            if(!$this->produtoFotoModel->create($produtoId, $foto)){
                die('Erro ao criar');
            }
        }
    }
    
    public function delete($id) {
        if (!$this->produtoFotoModel->delete($id)) {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Produto não encontrado";
        exit();
    }
}