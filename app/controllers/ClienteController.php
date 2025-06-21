<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\EnderecoModel;
use App\Models\ClienteModel;
use App\Views\ViewRenderer;

class ClienteController 
{
    private ClienteModel $clienteModel;
    private ViewRenderer $view;
    private EnderecoModel $enderecoModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
        $this->view = new ViewRenderer();
        $this->enderecoModel = new EnderecoModel();
    }

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
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_senha' => password_hash(filter_input(INPUT_POST, 'cliente_senha', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT)
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
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_senha' => password_hash(filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT)
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
            session_start();
            $_SESSION['cliente_id'] = $cliente->cliente_id;
            $_SESSION['cliente_nome'] = $cliente->cliente_nome;
            $_SESSION['cliente_email'] = $cliente->cliente_email;
            
            // Recuperar carrinho não logado se existir
            if (isset($_SESSION['carrinho_nao_logado'])) {
                $_SESSION['carrinho'] = $_SESSION['carrinho_nao_logado'];
                $_SESSION['cart_count'] = array_sum(array_column($_SESSION['carrinho'], 'quantidade'));
                unset($_SESSION['carrinho_nao_logado']);
            }
            
            header('Location: ' . ($_GET['redirect'] ?? '/'));
            exit;
        }

        $this->view->render('auth/login', ['error' => 'Credenciais inválidas']);
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Limpa todas as variáveis de sessão
        $_SESSION = array();
        
        // Destrói a sessão
        if (session_id() != "") {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }
        
        // Redireciona para a página inicial
        header('Location: /');
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

    public function profile(): void
    {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $cliente = $this->clienteModel->find($_SESSION['cliente_id']);
        
        $this->view->render('cliente/profile', [
            'cliente' => $cliente,
        ]);
    }
    public function address(): void
    {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $cliente = $this->clienteModel->find($_SESSION['cliente_id']);
        $endereco = $this->enderecoModel->findByClienteId($_SESSION['cliente_id']);
        
        $this->view->render('cliente/address', [
            'endereco' => $endereco,
            'cliente'=> $cliente
        ]);
    }

    public function updateProfile(): void
    {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $id = $_SESSION['cliente_id'];
        $data = [
            'cliente_nome' => filter_input(INPUT_POST, 'cliente_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_cpf' => filter_input(INPUT_POST, 'cliente_cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_email' => filter_input(INPUT_POST, 'cliente_email', FILTER_SANITIZE_EMAIL),
            'cliente_telefone' => filter_input(INPUT_POST, 'cliente_telefone', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        // Atualiza a senha apenas se for fornecida
        $novaSenha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($novaSenha)) {
            $data['cliente_senha'] = password_hash($novaSenha, PASSWORD_DEFAULT);
        }

        if ($this->clienteModel->update($id, $data)) {
            $_SESSION['cliente_nome'] = $data['cliente_nome'];
            $_SESSION['cliente_email'] = $data['cliente_email'];
            
            header('Location: /perfil?success=1');
            exit;
        }

        header('Location: /perfil?error=1');
        exit;
    }

    public function updateAddress(): void
    {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $data = [
            'cep' => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
            'logradouro' => filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_SPECIAL_CHARS),
            'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
            'cidade' => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        if ($this->enderecoModel->createOrUpdate($_SESSION['cliente_id'], $data)) {
            header('Location: /perfil?success=1');
            exit;
        }

        header('Location: /perfil?error=1');
        exit;
    }

    public function orders(): void
    {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        // Aqui você precisaria implementar um OrderModel para buscar os pedidos
        // $pedidos = $this->orderModel->findByClienteId($_SESSION['cliente_id']);
        
        // Por enquanto vamos apenas renderizar a view
        $this->view->render('cliente/orders', [
            // 'pedidos' => $pedidos
        ]);
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}