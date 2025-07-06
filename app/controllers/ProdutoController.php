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
        $filtros = [
            'produto_nome' => htmlspecialchars($_GET['produto_nome'] ?? ''),
            'marca_fk' => (int)($_GET['marca_fk'] ?? 0),
            'categoria_fk' => (int)($_GET['categoria_fk'] ?? 0),
            'preco_min' => (float)($_GET['preco_min'] ?? 0),
            'preco_max' => (float)($_GET['preco_max'] ?? PHP_FLOAT_MAX)
        ];
        
        $produtos = $this->produtoModel->getProdutosComFoto($filtros);
        $this->view->render('produto/produtos', [
            'produtos' => $produtos,
            'filtros' => $filtros
        ]);
    }

    public function show(int $produtoId)
    {
        $produto = $this->produtoModel->find($produtoId) ?? [];
        
        if (!$produto) {
            $this->notFound();
        }

        $produtoFotos = $this->produtoFotoModel->getByProduto($produtoId) ?? [];
        
        $this->view->render('produto/produto', [
            'produto' => $produto,
            'produtoFotos' => $produtoFotos,
            'primaryPhoto' => $this->getPrimaryPhoto($produtoFotos)
        ]);
    }

    public function create(): void
    {
        $this->view->render('produto/produtoCreate', [
            'marcas' => $this->marcaModel->getAll(),
            'categorias' => $this->categoriaModel->getAll()
        ]);
    }

    public function store(): void
    {
        $data = $this->getValidatedProductData();
        $createResult = $this->produtoModel->create($data);
        
        if ($createResult['queryResult']) {
            $this->handlePhotoUpload($createResult['produtoId'], $_FILES['produto_fotos'] ?? []);
            header('Location: /produtos');
            exit;
        }

        $this->handleError('Error creating product');
    }

    public function edit(int $produtoId): void
    {
        $produto = $this->produtoModel->find($produtoId);
        
        if (!$produto) {
            $this->notFound();
            return;
        }

        $this->view->render('produto/produtoEdit', [
            'marcas' => $this->marcaModel->getAll(),
            'categorias' => $this->categoriaModel->getAll(),
            'produto' => $produto,
            'fotos' => $this->produtoFotoModel->getByProduto($produtoId)
        ]);
    }

    public function update(): void
    {
        $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        $data = $this->getValidatedProductData();

        $updateResult = $this->produtoModel->update($produtoId, $data);
        
        if ($updateResult['queryResult']) {
            $this->handlePhotoUpload($produtoId, $_FILES['novas_fotos'] ?? []);
            
            // Deleta fotos se houver alguma selecionada
            if (!empty($_POST['deleted_photos'])) {
            $deletedPhotos = explode(',', $_POST['deleted_photos']);
                $this->handlePhotoDeletions($deletedPhotos);
            }

            // Handle primary photo change if needed
            if (!empty($_POST['primary_photo'])) {
                $this->produtoFotoController->setAsPrimary((int)$_POST['primary_photo']);
            }

            header('Location: /produtos');
            exit;
        } else {
            echo 'Erro ao modificar';
        }

    }

    public function delete(string $produtoId): void
    {
        if ($this->produtoModel->delete($produtoId)) {
            header('Location: /produtos');
            exit;
        }

        $this->handleError('Error deleting product');
    }

    private function getValidatedProductData(): array
    {
        return [
            'produto_nome' => filter_input(INPUT_POST, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'produto_descricao' => filter_input(INPUT_POST, 'produto_descricao', FILTER_SANITIZE_STRING),
            'marca_fk' => filter_input(INPUT_POST, 'marca_fk', FILTER_VALIDATE_INT),
            'categoria_fk' => filter_input(INPUT_POST, 'categoria_fk', FILTER_VALIDATE_INT),
            'produto_preco' => filter_input(INPUT_POST, 'produto_preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'produto_estoque' => filter_input(INPUT_POST, 'produto_estoque', FILTER_VALIDATE_INT)
        ];
    }

    private function handlePhotoUpload(int $produtoId, array $fotos): void
    {
        if (!empty($fotos['name'][0])) {
            $uploadResult = $this->produtoFotoController->store($produtoId, $fotos);

            if (!$uploadResult) {
                echo('Erro ao subir as fotos para o produto: ' . $produtoId);
            }

        } else {
            echo 'Nenhum arquivo encontrado';
        }
    }

    private function handlePhotoDeletions(array $photoIds): void
    {
        foreach ($photoIds as $photoId) {
            if (!empty($photoId)) {
                $this->produtoFotoController->delete((int)$photoId);
            }
        }
    }

    private function getPrimaryPhoto(array $fotos): ?\stdClass
    {
        foreach ($fotos as $foto) {
            if ($foto->is_primary) {
                return $foto;
            }
        }
        return !empty($fotos) ? $fotos[0] : null;
    }

    private function handleError(string $message): never
    {
        http_response_code(500);
        die($message);
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}