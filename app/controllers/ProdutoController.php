<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\{ProdutoModel, CategoriaModel, MarcaModel, ProdutoFotoModel};
use App\Views\ViewRenderer;

class ProdutoController
{
    public function __construct(
        private ProdutoModel $produtoModel = new ProdutoModel(),
        private ProdutoFotoController $produtoFotoController = new ProdutoFotoController(),
        private ProdutoFotoModel $produtoFotoModel = new ProdutoFotoModel(),
        private CategoriaModel $categoriaModel = new CategoriaModel(),
        private MarcaModel $marcaModel = new MarcaModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function index(): void
    {
        $produtos = $this->produtoModel->getAll();
        $this->view->render('produto/index', ['produtos' => $produtos]);
    }

    public function show(string $produtoId): void
    {
        $produto = $this->produtoModel->find($produtoId);
        
        if (!$produto) {
            $this->notFound();
        }

        $produtoFotos = $this->produtoFotoModel->getByProduto($produtoId);
        $this->view->render('produto/show', [
            'produto' => $produto,
            'produtoFotos' => $produtoFotos
        ]);
    }

    public function create(): void
    {
        $data = [
            'marcas' => $this->marcaModel->getAll(),
            'categorias' => $this->categoriaModel->getAll()
        ];
        
        $this->view->render('produto/create', $data);
    }

    public function store(): void
    {
        $data = [
            'produto_nome' => filter_input(INPUT_POST, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'produto_descricao' => filter_input(INPUT_POST, 'produto_descricao', FILTER_SANITIZE_SPECIAL_CHARS),
            'produto_preco' => filter_input(INPUT_POST, 'produto_preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'marca_fk' => filter_input(INPUT_POST, 'marca_fk', FILTER_VALIDATE_INT),
            'categoria_fk' => filter_input(INPUT_POST, 'categoria_fk', FILTER_VALIDATE_INT),
            'produto_estoque' => filter_input(INPUT_POST, 'produto_estoque', FILTER_VALIDATE_INT)
        ];

        $createResult = $this->produtoModel->create($data);
        
        if ($createResult['queryResult']) {
            $this->produtoFotoController->store(
                $createResult['produtoId'], 
                $_FILES['produto_fotos'] ?? []
            );
            
            header('Location: /produtos');
            exit;
        }

        http_response_code(500);
        die('Error creating product');
    }

    public function edit(string $produtoId): void
    {
        $produto = $this->produtoModel->find($produtoId);
        
        if (!$produto) {
            $this->notFound();
        }

        $data = [
            'marcas' => $this->marcaModel->getAll(),
            'categorias' => $this->categoriaModel->getAll(),
            'produto' => $produto
        ];
        
        $this->view->render('produto/edit', $data);
    }

    public function update(): void
    {
        $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        
        $data = [
            'produto_nome' => filter_input(INPUT_POST, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'produto_descricao' => filter_input(INPUT_POST, 'produto_descricao', FILTER_SANITIZE_SPECIAL_CHARS),
            'marca_fk' => filter_input(INPUT_POST, 'marca_fk', FILTER_VALIDATE_INT),
            'categoria_fk' => filter_input(INPUT_POST, 'categoria_fk', FILTER_VALIDATE_INT),
            'produto_preco' => filter_input(INPUT_POST, 'produto_preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'produto_estoque' => filter_input(INPUT_POST, 'produto_estoque', FILTER_VALIDATE_INT)
        ];

        if ($this->produtoModel->update($produtoId, $data)) {
            header('Location: /produtos');
            exit;
        }

        http_response_code(500);
        die('Error updating product');
    }

    public function delete(string $produtoId): void
    {
        if ($this->produtoModel->delete($produtoId)) {
            header('Location: /produtos');
            exit;
        }

        http_response_code(500);
        die('Error deleting product');
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}