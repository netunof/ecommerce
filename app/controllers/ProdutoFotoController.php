<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProdutoFotoModel;
use App\Views\ViewRenderer;

class ProdutoFotoController 
{
    public function __construct(
        private ProdutoFotoModel $produtoFotoModel = new ProdutoFotoModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function store(int $produtoId, array $fotos): bool
    {
        if (empty($fotos)) {
            return false;
        }
        
        $success = true;
        foreach ($fotos as $foto) {
            if (!$this->produtoFotoModel->create($produtoId, $foto)) {
                $success = false;
                break;
            }
        }
        
        return $success;
    }

    public function delete(int $id): void
    {
        if (!$this->produtoFotoModel->delete($id)) {
            http_response_code(500);
            die('Error deleting product photo');
        }
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}