<?php
namespace App\Models;

use App\Config\Database;

class ProdutoFotoModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getByProduto($produtoId) {
        try {
            $query = $this->db->prepare("SELECT * FROM produto_foto 
            WHERE produto_fk = :produto_fk ORDER BY produto_foto_id");
            
            $query->execute([':produto_fk' => $produtoId]);
            
            return $query->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            error_log("Database error in getByProduto: " . $e->getMessage());
            return [];
        }
    }
    
    public function getById($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM produto_foto WHERE produto_foto_id = :id");
            $query->execute([':id' => $id]);
            return $query->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            error_log("Database error in getById: " . $e->getMessage());
            return null;
        }
    }
    
    public function create($produtoId, $filename) {
        $query = $this->db->prepare("INSERT INTO produto_foto (file_name, produto_fk, created_at)
            VALUES (:file_name, :produto_fk, NOW())");
        
        return $query->execute([
            ':file_name' => $filename,
            ':produto_fk' => $produtoId
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM produto_foto WHERE produto_foto_id = :produto_foto_id");
        return $query->execute([':produto_foto_id' => $id]);
    }
}