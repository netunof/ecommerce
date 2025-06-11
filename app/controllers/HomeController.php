<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\{CategoriaModel, MarcaModel, ProdutoModel};
use App\Views\ViewRenderer;

class HomeController 
{
    public function __construct(
        private CategoriaModel $categoriaModel = new CategoriaModel(),
        private MarcaModel $marcaModel = new MarcaModel(),
        private ProdutoModel $produtoModel = new ProdutoModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function home(): void
    {
        $data = [
            'categorias' => $this->categoriaModel->getAll(),
            'marcas' => $this->marcaModel->getAll(),
            'produtos' => $this->produtoModel->getAll()
        ];
        
        $this->view->render('home', $data);
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}