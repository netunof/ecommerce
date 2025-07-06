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
        $this->view->render('marca/marcas', ['marcas' => $marcas]);
    }

    public function show(int $id): void
    {
        $marca = $this->marcaModel->find($id);
        
        if (!$marca) {
            $this->notFound();
        }

        $this->view->render('marca/marca', ['marca' => $marca]);
    }

    public function create(): void
    {
        $this->view->render('marca/marcaCreate');
    }

    public function store(): void
    {
        // Verifica se é uma requisição AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        $data = $this->getValidatedData();
        
        $result = $this->marcaModel->create($data);
        
        if ($isAjax) {
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'marca_id' => $this->marcaModel->lastId(),
                    'marca_nome' => $data['marca_nome']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Erro ao criar marca'
                ]);
            }
            exit;
        }
        
        if ($result) {
            header('Location: /marcas');
            exit;
        }
        
        $this->handleError('Erro ao criar marca');
    }

    public function edit(int $id): void
    {
        $marca = $this->marcaModel->find($id);
        
        if (!$marca) {
            $this->notFound();
        }

        $this->view->render('marca/marcaEdit', ['marca' => $marca]);
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

    private function getValidatedData(): array
    {
        $nome = filter_input(INPUT_POST, 'marca_nome', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (empty($nome)) {
            $nome = filter_input(INPUT_POST, 'marca_nome', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($nome)) {
            $this->handleError('Nome da marca é obrigatório');
        }

        return [
            'marca_nome' => $nome
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
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/marcas'));
        exit;
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}