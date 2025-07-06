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
        $this->view->render('categoria/categorias', ['categorias' => $categorias]);
    }

    public function show(int $id): void
    {
        $categoria = $this->categoriaModel->find($id);
        
        if (!$categoria) {
            $this->notFound();
        }

        $this->view->render('categoria/categoria', ['categoria' => $categoria]);
    }

    public function create(): void
    {
        $this->view->render('categoria/categoriaCreate');
    }

    public function store(): void
    {
        // Verifica se é uma requisição AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        $data = $this->getValidatedData();
        
        $result = $this->categoriaModel->create($data);
        
        if ($isAjax) {
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'categoria_id' => $this->categoriaModel->lastId(),
                    'categoria_nome' => $data['categoria_nome']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Erro ao criar categoria'
                ]);
            }
            exit;
        }
        
        if ($result) {
            header('Location: /categorias');
            exit;
        }
        
        $this->handleError('Erro ao criar categoria');
    }

    public function edit(int $id): void
    {
        $categoria = $this->categoriaModel->find($id);
        
        if (!$categoria) {
            $this->notFound();
        }

        $this->view->render('categoria/categoriaEdit', ['categoria' => $categoria]);
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

    private function getValidatedData(): array
    {
        $nome = filter_input(INPUT_POST, 'categoria_nome', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (empty($nome)) {
            $nome = filter_input(INPUT_POST, 'categoria_nome', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($nome)) {
            $this->handleError('Nome da categoria é obrigatório');
        }

        return [
            'categoria_nome' => $nome
        ];
    }

    private function handleError(string $message, bool $isAjax = false): never
    {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => $message
            ]);
            exit;
        }

        $_SESSION['error_message'] = $message;
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/categorias'));
        exit;
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}