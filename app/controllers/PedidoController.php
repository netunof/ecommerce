<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\{PedidoModel, PedidoItemModel, ClienteModel};
use App\Views\ViewRenderer;

class PedidoController
{
    private PedidoModel $pedidoModel;
    private PedidoItemModel $pedidoItemModel;
    private ClienteModel $clienteModel;
    private ViewRenderer $view;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->pedidoItemModel = new PedidoItemModel();
        $this->clienteModel = new ClienteModel();
        $this->view = new ViewRenderer();
    }

    public function confirmacao(int $pedidoId): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $pedido = $this->pedidoModel->find($pedidoId);
        $itens = $this->pedidoItemModel->getByPedido($pedidoId);
        $cliente = $this->clienteModel->find($_SESSION['cliente_id']);

        // Verificar se o pedido pertence ao cliente
        if (!$pedido || $pedido->cliente_fk != $_SESSION['cliente_id']) {
            header('Location: /perfil/pedidos');
            exit;
        }

        $this->view->render('pedido/confirmacao', [
            'pedido' => $pedido,
            'itens' => $itens,
            'cliente' => $cliente
        ]);
    }

    public function listar(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $pedidos = $this->pedidoModel->findByCliente($_SESSION['cliente_id']);

        $this->view->render('pedido/listar', [
            'pedidos' => $pedidos
        ]);
    }

    public function detalhes(int $pedidoId): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /login');
            exit;
        }

        $pedido = $this->pedidoModel->find($pedidoId);
        $itens = $this->pedidoItemModel->getByPedido($pedidoId);
        $cliente = $this->clienteModel->find($_SESSION['cliente_id']);

        // Verificar se o pedido pertence ao cliente
        if (!$pedido || $pedido->cliente_fk != $_SESSION['cliente_id']) {
            header('Location: /perfil/pedidos');
            exit;
        }

        $this->view->render('pedido/detalhes', [
            'pedido' => $pedido,
            'itens' => $itens,
            'cliente' => $cliente
        ]);
    }
}