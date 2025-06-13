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

    public function show(int $id): void
    {
        $cliente = $this->clienteModel->find($id);
        
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

    public function edit(int $id): void
    {
        $cliente = $this->clienteModel->find($id);
        
        if (!$cliente) {
            $this->notFound();
        }

        $this->view->render('cliente/edit', ['cliente' => $cliente]);
    }

    public function update(int $id): void
    {
        $data = [
            'cliente_nome' => filter_input(INPUT_POST, 'cliente_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_cpf' => filter_input(INPUT_POST, 'cliente_cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_email' => filter_input(INPUT_POST, 'cliente_email', FILTER_SANITIZE_EMAIL),
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->clienteModel->update($id, $data)) {
            header('Location: /clientes');
            exit;
        }

        http_response_code(500);
        die('Error updating client');
    }

    public function delete(int $id): void
    {
        if ($this->clienteModel->delete($id)) {
            header('Location: /clientes');
            exit;
        }

        http_response_code(500);
        die('Error deleting client');
    }

    public function loginForm(): void
    {
        $this->view->render('auth/login');
    }

    public function login(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $cliente = $this->clienteModel->authenticate($email, $password);

        if ($cliente) {
            $_SESSION['cliente_id'] = $cliente->cliente_id;
            $_SESSION['cliente_nome'] = $cliente->cliente_nome;
            $_SESSION['cliente_email'] = $cliente->cliente_email;
            
            header('Location: /');
            exit;
        }

        $this->view->render('auth/login', ['error' => 'Credenciais inválidas']);
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function registerForm(): void
    {
        $this->view->render('auth/register');
    }

    public function register(): void
    {
        $data = [
            'cliente_nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'cliente_telefone' => filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_senha' => password_hash(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT)
        ];

        if ($this->clienteModel->create($data)) {
            $_SESSION['cliente_id'] = $this->clienteModel->lastInsertId();
            $_SESSION['cliente_nome'] = $data['cliente_nome'];
            $_SESSION['cliente_email'] = $data['cliente_email'];
            
            header('Location: /');
            exit;
        }

        $this->view->render('auth/register', ['error' => 'Erro ao cadastrar cliente']);
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}