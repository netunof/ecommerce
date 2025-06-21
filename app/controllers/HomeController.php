<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\{CategoriaModel, MarcaModel, ProdutoModel};
use App\Views\ViewRenderer;

class HomeController 
{
    public function __construct(
        private CategoriaModel $categoriaModel = new CategoriaModel(),
        private MarcaModel $marcaModel = new MarcaModel(),
        private ProdutoModel $produtoModel = new ProdutoModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    // Adicione este método à classe HomeController
    private function getPaginationLinks(int $currentPage, $totalPages, array $queryParams = []): array
    {
        // Forçar conversão para int se for float
        $totalPages = (int)$totalPages;
        
        $links = [];
        
        // Remove página atual dos parâmetros de query se existir
        unset($queryParams['page']);
        
        // Monta a base da URL com os parâmetros existentes
        $baseUrl = '/?' . http_build_query($queryParams);
        
        // Link para página anterior
        if ($currentPage > 1) {
            $links[] = [
                'url' => $baseUrl . '&page=' . ($currentPage - 1),
                'label' => '&laquo;',
                'active' => false
            ];
        }
        
        // Links das páginas
        $start = max(1, $currentPage - 2);
        $end = min($totalPages, $currentPage + 2);
        
        for ($i = $start; $i <= $end; $i++) {
            $links[] = [
                'url' => $baseUrl . '&page=' . $i,
                'label' => $i,
                'active' => $i === $currentPage
            ];
        }
        
        // Link para próxima página
        if ($currentPage < $totalPages) {
            $links[] = [
                'url' => $baseUrl . '&page=' . ($currentPage + 1),
                'label' => '&raquo;',
                'active' => false
            ];
        }
        
        return $links;
    }

    // Atualize o método home para incluir a paginação
    public function home(array $filters = []): void
    {
        $currentPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
        $itemsPerPage = 12;
        
        $result = $this->produtoModel->getPaginatedProdutosComFoto([
            'produto_nome' => $filters['produto_nome'] ?? filter_input(INPUT_GET, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'marca_fk' => $filters['marca_fk'] ?? filter_input(INPUT_GET, 'marca_id', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY) ?: [],
            'categoria_fk' => $filters['categoria_fk'] ?? filter_input(INPUT_GET, 'categoria_id', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY) ?: [],
            'preco_min' => $filters['preco_min'] ?? filter_input(INPUT_GET, 'preco_min', FILTER_VALIDATE_FLOAT),
            'preco_max' => $filters['preco_max'] ?? filter_input(INPUT_GET, 'preco_max', FILTER_VALIDATE_FLOAT)
        ], $currentPage, $itemsPerPage);
        
        $data = [
            'categorias' => $this->categoriaModel->getAll(),
            'marcas' => $this->marcaModel->getAll(),
            'produtos' => $result['data'],
            'pagination' => [
                'current_page' => $currentPage,
                'total_pages' => (int)$result['last_page'], // Convertendo para int aqui também
                'total_items' => $result['total'],
                'items_per_page' => $itemsPerPage,
                'links' => $this->getPaginationLinks($currentPage, $result['last_page'], $_GET)
            ]
        ];
        
        $this->view->render('home', $data);
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}