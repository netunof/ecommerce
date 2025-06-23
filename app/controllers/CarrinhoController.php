<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\{ProdutoModel, PedidoModel, PedidoItemModel};
use App\Views\ViewRenderer;

class CarrinhoController 
{
    private ProdutoModel $produtoModel;
    private PedidoModel $pedidoModel;
    private PedidoItemModel $pedidoItemModel;
    private ViewRenderer $view;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->pedidoModel = new PedidoModel();
        $this->pedidoItemModel = new PedidoItemModel();
        $this->view = new ViewRenderer();
    }

    public function index(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        $carrinho = $_SESSION['carrinho'] ?? [];
        $produtos = [];
        $total = 0;

        foreach ($carrinho as $produtoId => $item) {
            $produto = $this->produtoModel->find($produtoId);
            if ($produto) {
                $produto->quantidade = $item['quantidade'];
                $produto->subtotal = $item['quantidade'] * $produto->produto_preco;
                $total += $produto->subtotal;
                $produtos[] = $produto;
            }
        }

        $this->view->render('carrinho/index', [
            'produtos' => $produtos,
            'total' => $total
        ]);
    }

    public function adicionar(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if (!$produtoId || !$quantidade) {
            header('Location: /carrinho');
            exit;
        }

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        if (isset($_SESSION['carrinho'][$produtoId])) {
            $_SESSION['carrinho'][$produtoId]['quantidade'] += $quantidade;
        } else {
            $_SESSION['carrinho'][$produtoId] = [
                'quantidade' => $quantidade
            ];
        }

        $_SESSION['cart_count'] = array_sum(array_column($_SESSION['carrinho'], 'quantidade'));
        
        header('Location: /carrinho');
        exit;
    }

    public function atualizar(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if (!$produtoId || !$quantidade || !isset($_SESSION['carrinho'][$produtoId])) {
            header('Location: /carrinho');
            exit;
        }

        $_SESSION['carrinho'][$produtoId]['quantidade'] = $quantidade;
        $_SESSION['cart_count'] = array_sum(array_column($_SESSION['carrinho'], 'quantidade'));
        
        header('Location: /carrinho');
        exit;
    }

    public function remover(int $produtoId): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        
        if (isset($_SESSION['carrinho'][$produtoId])) {
            unset($_SESSION['carrinho'][$produtoId]);
            $_SESSION['cart_count'] = array_sum(array_column($_SESSION['carrinho'], 'quantidade'));
        }
        
        header('Location: /carrinho');
        exit;
    }

    public function limpar(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        unset($_SESSION['carrinho']);
        unset($_SESSION['cart_count']);
        header('Location: /carrinho');
        exit;
    }

    public function finalizar(): void
    {
        session_status() === PHP_SESSION_NONE ? session_start() : false;
        
        if (!isset($_SESSION['cliente_id'])) {
            $_SESSION['redirect_url'] = '/carrinho/finalizar';
            header('Location: /login');
            exit;
        }

        if (empty($_SESSION['carrinho'])) {
            header('Location: /carrinho');
            exit;
        }

        $clienteId = $_SESSION['cliente_id'];
        $total = $this->getTotalCarrinho();
        
        // Criar pedido
        $pedidoId = $this->pedidoModel->create([
            'cliente_fk' => $clienteId,
            'total' => $total
        ]);

        // Adicionar itens ao pedido
        foreach ($_SESSION['carrinho'] as $produtoId => $item) {
            $produto = $this->produtoModel->find($produtoId);
            if ($produto) {
                $this->pedidoItemModel->create([
                    'produto_fk' => $produtoId,
                    'pedido_fk' => $pedidoId,
                    'pedido_item_quantidade' => $item['quantidade']
                ]);
            }
        }

        // Limpar carrinho
        $this->limpar();

        // Redirecionar para confirmação
        header("Location: /pedido/confirmacao/$pedidoId");
        exit;
    }

    private function getTotalCarrinho(): float
    {
        $total = 0;
        foreach ($_SESSION['carrinho'] ?? [] as $produtoId => $item) {
            $produto = $this->produtoModel->find($produtoId);
            if ($produto) {
                $total += $item['quantidade'] * $produto->produto_preco;
            }
        }
        return $total;
    }
}