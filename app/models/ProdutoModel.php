<?php
require_once "config/database.php";
class Produto {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM produto ORDER BY produto_id");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getFilter($data) {
        $query = $this->db->prepare("SELECT * FROM produto 
        WHERE (produto_nome LIKE '%':produto_nome'%' OR :produto_nome = '')
        AND (produto_marca = :produto_marca OR :produto_marca = 0)
        AND (produto_categoria = :produto_categoria or :produto_categoria = 0)
        AND (produto_preco BETWEEN :preco_max AND :preco_min)
        ORDER BY produto_id");
        $query->execute([
            ':produto_nome' => $data['produto_nome'],
            ':produto_marca' => $data['produto_marca'],
            ':produto_categoria' => $data['produto_categoria'],
            ':preco_max' => $data['preco_max'],
            ':preco_min ' => $data['preco_min']
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM produto WHERE produto_id = :produto_id");
        $query->execute([':produto_id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO produto (produto_nome, produto_descricao, produto_marca, produto_categoria, produto_preco, produto_estoque, created_at) 
            VALUES (:produto_nome, :produto_descricao, :produto_marca, :produto_categoria, :produto_preco, :produto_estoque, NOW())
        ");
        return $query->execute([
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':produto_marca' => $data['produto_marca'],
            ':produto_categoria' => $data['produto_categoria'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']
        ]);
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE produto 
            SET produto_nome = :produto_nome, produto_descricao = :produto_descricao, produto_marca = :produto_marca, 
            produto_categoria = :produto_categoria, produto_preco = :produto_preco, produto_estoque = :produto_estoque 
            WHERE produto_id = :produto_id
        ");
        return $query->execute([
            ':produto_id' => $id,
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':produto_marca' => $data['produto_marca'],
            ':produto_categoria' => $data['produto_categoria'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM produto WHERE produto_id = :produto_id");
        return $query->execute([':produto_id' => $id]);
    }
}