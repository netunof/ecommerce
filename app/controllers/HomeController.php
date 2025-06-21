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

    public function home(array $filters = []): void
    {
        $data = [
            'categorias' => $this->categoriaModel->getAll(),
            'marcas' => $this->marcaModel->getAll(),
            'produtos' => $this->produtoModel->getProdutosComFoto([
                'produto_nome' => filter_input(INPUT_GET, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS),
                'marca_fk' => filter_input(INPUT_GET, 'marca_id', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY) ?: [],
                'categoria_fk' => filter_input(INPUT_GET, 'categoria_id', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY) ?: [],
                'preco_min' => filter_input(INPUT_GET, 'preco_min', FILTER_VALIDATE_FLOAT),
                'preco_max' => filter_input(INPUT_GET, 'preco_max', FILTER_VALIDATE_FLOAT)
            ])
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