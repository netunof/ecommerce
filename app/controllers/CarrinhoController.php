<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Views\ViewRenderer;

class CarrinhoController 
{
    private ProdutoModel $produtoModel;
    private ViewRenderer $view;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
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
}