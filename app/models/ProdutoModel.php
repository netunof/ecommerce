<?php
namespace App\Models;

use App\Config\Database;
class ProdutoModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $query = $this->db->query("SELECT * FROM produto ORDER BY produto_id");
        
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function getProdutosComFoto($data) {
        $query = $this->db->prepare("SELECT p.*, f.file_name 
            FROM produto p 
            LEFT JOIN (
                SELECT pf.* FROM produto_foto pf 
                INNER JOIN (
                    SELECT produto_fk, MIN(produto_foto_id) as min_id 
                    FROM produto_foto 
                    GROUP BY produto_fk
                ) as first ON pf.produto_foto_id = first.min_id
            ) f ON f.produto_fk = p.produto_id
            WHERE (p.produto_nome LIKE '%' || :produto_nome || '%' OR :produto_nome = '')
            AND (p.marca_fk = :marca_fk OR :marca_fk = 0)
            AND (p.categoria_fk = :categoria_fk OR :categoria_fk = 0)
            AND (p.produto_preco BETWEEN :preco_min AND :preco_max)
            ORDER BY p.produto_id");
        
        $params = [
            ':produto_nome' => $data['produto_nome'] ?? '',
            ':marca_fk' => $data['marca_fk'] ?? 0,
            ':categoria_fk' => $data['categoria_fk'] ?? 0,
            ':preco_min' => $data['preco_min'] ?? 0,
            ':preco_max' => $data['preco_max'] ?? PHP_FLOAT_MAX
        ];
        
        // Força a tipagem
        $params[':marca_fk'] = (int)$params[':marca_fk'];
        $params[':categoria_fk'] = (int)$params[':categoria_fk'];
        $params[':preco_min'] = (float)$params[':preco_min'];
        $params[':preco_max'] = (float)$params[':preco_max'];
        
        error_log("Executing query: " . $query->queryString);
        error_log("With parameters: " . print_r($params, true));
        
        $query->execute($params);

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function find($produtoId) {
        $query = $this->db->prepare("SELECT * FROM produto WHERE produto_id = :produto_id");
        
        $query->execute([':produto_id' => $produtoId]);
        
        return $query->fetch(\PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO produto (produto_nome, produto_descricao, marca_fk, categoria_fk, produto_preco, produto_estoque, created_at) 
            VALUES (:produto_nome, :produto_descricao, :marca_fk, :categoria_fk, :produto_preco, :produto_estoque, NOW())");

        $queryResult = $query->execute([
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':marca_fk' => $data['marca_fk'],
            ':categoria_fk' => $data['categoria_fk'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']]);
        return [
            'queryResult' => $queryResult,
            'produtoId' => (int)$this->db->lastInsertId()
        ];
    }
    
    public function update($produtoId, $data) {
        $query = $this->db->prepare("UPDATE produto 
            SET produto_nome = :produto_nome, produto_descricao = :produto_descricao, marca_fk = :marca_fk, 
            categoria_fk = :categoria_fk, produto_preco = :produto_preco, produto_estoque = :produto_estoque 
            WHERE produto_id = :produto_id");
        
        $queryResult = $query->execute([
            ':produto_id' => $produtoId,
            ':produto_nome' => $data['produto_nome'],
            ':produto_descricao' => $data['produto_descricao'],
            ':marca_fk' => $data['marca_fk'],
            ':categoria_fk' => $data['categoria_fk'],
            ':produto_preco' => $data['produto_preco'],
            ':produto_estoque' => $data['produto_estoque']]);
        return [
            'queryResult' => $queryResult,
            'produtoId' => (int)$produtoId
        ];
    }
    
    public function delete($produtoId) {
        $query = $this->db->prepare("DELETE FROM produto WHERE produto_id = :produto_id");
 
        return $query->execute([':produto_id' => $produtoId]);
    }
}