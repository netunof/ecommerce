<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\MarcaModel;
use App\Views\ViewRenderer;

class MarcaController 
{
    public function __construct(
        private MarcaModel $marcaModel = new MarcaModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function index(): void
    {
        $marcas = $this->marcaModel->getAll();
        $this->view->render('marca/index', ['marcas' => $marcas]);
    }

    public function show(int $id): void
    {
        $marca = $this->marcaModel->find($id);
        
        if (!$marca) {
            $this->notFound();
        }

        $this->view->render('marca/show', ['marca' => $marca]);
    }

    public function create(): void
    {
        $this->view->render('marca/create');
    }

    public function store(): void
    {
        $data = [
            'marca_nome' => filter_input(INPUT_POST, 'marca_nome', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->marcaModel->create($data)) {
            header('Location: /marcas');
            exit;
        }

        http_response_code(500);
        die('Error creating brand');
    }

    public function edit(int $id): void
    {
        $marca = $this->marcaModel->find($id);
        
        if (!$marca) {
            $this->notFound();
        }

        $this->view->render('marca/edit', ['marca' => $marca]);
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'marca_id', FILTER_VALIDATE_INT);
        $data = [
            'marca_nome' => filter_input(INPUT_POST, 'marca_nome', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->marcaModel->update($id, $data)) {
            header('Location: /marcas');
            exit;
        }

        http_response_code(500);
        die('Error updating brand');
    }

    public function delete(int $id): void
    {
        if ($this->marcaModel->delete($id)) {
            header('Location: /marcas');
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