<?php
require_once "app/models/ProdutoModel.php";
require_once "app/models/CategoriaModel.php";
require_once "app/models/MarcaModel.php";
class ProdutoController {
    private $produtoModel;
    private $categoriaModel;
    private $marcaModel;
    
    public function __construct() {
        $this->produtoModel = new Produto();
        $this->categoriaModel = new Categoria();
        $this->marcaModel = new Marca();
    }
    
    public function index() {
        $produtos = $this->produtoModel->getAll();
        /*[':produto_nome' => 'produto_nome',
        ':produto_marca' => 'produto_marca', ':produto_modelo' => 'produto_modelo',
        ':preco_max' => 'preco_max', ':preco_min ' => 'preco_min']*/
        require_once 'app/views/produto/index.php';
    }
    
    public function show($id) {
        $produto = $this->produtoModel->find($id);
        if ($produto) {
            require_once 'app/views/produto/show.php';
        } else {
            $this->notFound();
        }
    }
    
    public function create() {
        $data = ['marcas' => $this->marcaModel->getAll(),
                'categorias' => $this->categoriaModel->getAll()];
        require_once 'app/views/produto/create.php';
    }
    public function debug() {
        
        echo(file_get_contents($_FILES['produto_fotos']['tmp_name'][0]));
        print_r($_FILES);
    }

    public function store() {
        $data = [
            'produto_nome' => $_POST['produto_nome'],
            'produto_descricao' => $_POST['produto_descricao'],
            'produto_preco' => $_POST['produto_preco'],
            'marca_fk' => $_POST['marca_fk'],
            'categoria_fk' => $_POST['categoria_fk'],
            'produto_estoque' => $_POST['produto_estoque']
        ];
        $pictures = $_FILES['produto_fotos']['tmp_name'];

        if ($this->produtoModel->create($data, $pictures)) {
            header('Location: /produtos');
        } else {
            die('Erro ao criar');
        }
    }
    
    public function edit($id) {
        $data = ['marcas' => $this->marcaModel->getAll(),
                'categorias' => $this->categoriaModel->getAll()];
        $produto = $this->produtoModel->find($id);
        require_once 'app/views/produto/edit.php';
    }
    public function update() {
        $id = $_POST['produto_id'];
        $data = [
            'produto_nome' => $_POST['produto_nome'],
            'produto_descricao' => $_POST['produto_descricao'],
            'marca_fk' => $_POST['marca_fk'],
            'categoria_fk' => $_POST['categoria_fk'],
            'produto_preco' => $_POST['produto_preco'],
            'produto_estoque' => $_POST['produto_estoque']
        ];
            
        if ($this->produtoModel->update($id, $data)) {
            header('Location: /produtos');
        } else {
            die('Erro ao modificar');
        }
    }
    
    public function delete($id) {
        if ($this->produtoModel->delete($id)) {
            header('Location: /produto');
        } else {
            die('Erro ao apagar');
        }
    }
    
    private function notFound() {
        http_response_code(404);
        echo "404 - Produto não encontrado";
        exit();
    }
}