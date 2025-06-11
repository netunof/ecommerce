<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Views\ViewRenderer;

class CategoriaController 
{
    public function __construct(
        private CategoriaModel $categoriaModel = new CategoriaModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function index(): void
    {
        $categorias = $this->categoriaModel->getAll();
        $this->view->render('categoria/index', ['categorias' => $categorias]);
    }

    public function show(int $id): void
    {
        $categoria = $this->categoriaModel->find($id);
        
        if (!$categoria) {
            $this->notFound();
        }

        $this->view->render('categoria/show', ['categoria' => $categoria]);
    }

    public function create(): void
    {
        $this->view->render('categoria/create');
    }

    public function store(): void
    {
        $data = [
            'categoria_nome' => filter_input(INPUT_POST, 'categoria_nome', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->categoriaModel->create($data)) {
            header('Location: /categorias');
            exit;
        }

        http_response_code(500);
        die('Error creating brand');
    }

    public function edit(int $id): void
    {
        $categoria = $this->categoriaModel->find($id);
        
        if (!$categoria) {
            $this->notFound();
        }

        $this->view->render('categoria/edit', ['categoria' => $categoria]);
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);
        $data = [
            'categoria_nome' => filter_input(INPUT_POST, 'categoria_nome', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->categoriaModel->update($id, $data)) {
            header('Location: /categorias');
            exit;
        }

        http_response_code(500);
        die('Error updating brand');
    }

    public function delete(int $id): void
    {
        if ($this->categoriaModel->delete($id)) {
            header('Location: /categorias');
            exit;
        }

        http_response_code(500);
        die('Error deleting brand');
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}