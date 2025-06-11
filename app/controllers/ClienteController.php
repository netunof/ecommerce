<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Views\ViewRenderer;

class ClienteController 
{
    public function __construct(
        private ClienteModel $clienteModel = new ClienteModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function index(): void
    {
        $clientes = $this->clienteModel->getAll();
        $this->view->render('cliente/index', ['clientes' => $clientes]);
    }

    public function show(int $clienteId): void
    {
        $cliente = $this->clienteModel->find($clienteId);
        
        if (!$cliente) {
            $this->notFound();
        }

        $this->view->render('cliente/show', ['cliente' => $cliente]);
    }

    public function create(): void
    {
        $this->view->render('cliente/create');
    }

    public function store(): void
    {
        $data = [
            'cliente_nome' => filter_input(INPUT_POST, 'cliente_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_cpf' => filter_input(INPUT_POST, 'cliente_cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_email' => filter_input(INPUT_POST, 'cliente_email', FILTER_SANITIZE_EMAIL),
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->clienteModel->create($data)) {
            header('Location: /clientes');
            exit;
        }

        http_response_code(500);
        die('Error creating client');
    }

    public function edit(int $clienteId): void
    {
        $cliente = $this->clienteModel->find($clienteId);
        
        if (!$cliente) {
            $this->notFound();
        }

        $this->view->render('cliente/edit', ['cliente' => $cliente]);
    }

    public function update(): void
    {
        $clienteId = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
        
        $data = [
            'cliente_nome' => filter_input(INPUT_POST, 'cliente_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_cpf' => filter_input(INPUT_POST, 'cliente_cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_email' => filter_input(INPUT_POST, 'cliente_email', FILTER_SANITIZE_EMAIL),
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->clienteModel->update($clienteId, $data)) {
            header('Location: /clientes');
            exit;
        }

        http_response_code(500);
        die('Error updating client');
    }

    public function delete(int $clienteId): void
    {
        if ($this->clienteModel->delete($clienteId)) {
            header('Location: /clientes');
            exit;
        }

        http_response_code(500);
        die('Error deleting client');
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}