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
    
    
    public function create($produtoId, $foto) {
        $query = $this->db->prepare("INSERT INTO produto_foto (file_name, file_content, produto_fk, created_at)
            VALUES (:file_name, :file_content, :produto_fk, NOW())");
        
        return $query->execute([
            ':file_name'=> $foto['name'],
            ':file_content'=> base64_encode(file_get_contents($foto['tmp_name'])),
            ':produto_fk'=> $produtoId
        ]);
            
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM produto_foto WHERE produto_foto_id = :produto_foto_id");
        
        return $query->execute([':produto_foto_id' => $id]);
    }
}