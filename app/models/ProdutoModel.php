<?php
require_once "config/database.php";
class Produto {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $query = $this->db->query("SELECT * FROM produto ORDER BY produto_id");
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getFilter($data) {
        $query = $this->db->prepare("SELECT * FROM produto 
        WHERE (produto_nome LIKE '%':produto_nome'%' OR :produto_nome = '')
        AND (marca_fk = :marca_fk OR :marca_fk = 0)
        AND (categoria_fk = :categoria_fk or :categoria_fk = 0)
        AND (produto_preco BETWEEN :preco_max AND :preco_min)
        ORDER BY produto_id");
        
        $query->execute([
            ':produto_nome' => $data['produto_nome'],
            ':marca_fk' => $data['marca_fk'],
            ':categoria_fk' => $data['categoria_fk'],
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
        $query = $this->db->prepare("INSERT INTO produto (produto_nome, produto_descricao, marca_fk, categoria_fk, produto_preco, produto_estoque, created_at) 
            VALUES (:produto_nome, :produto_descricao, :marca_fk, :categoria_fk, :produto_preco, :produto_estoque, NOW())");

        return ['queryResult' => 
            $query->execute([
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':marca_fk' => $data['marca_fk'],
            ':categoria_fk' => $data['categoria_fk'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']
       ]), 'produtoId' => Database::lastId()];
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE produto 
            SET produto_nome = :produto_nome, produto_descricao = :produto_descricao, marca_fk = :marca_fk, 
            categoria_fk = :categoria_fk, produto_preco = :produto_preco, produto_estoque = :produto_estoque 
            WHERE produto_id = :produto_id");
        
        return $query->execute([
            ':produto_id' => $id,
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':marca_fk' => $data['marca_fk'],
            ':categoria_fk' => $data['categoria_fk'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM produto WHERE produto_id = :produto_id");
 
        return $query->execute([':produto_id' => $id]);
    }
}