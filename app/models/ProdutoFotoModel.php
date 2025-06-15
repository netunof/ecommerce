<?php
namespace App\Models;

use App\Config\Database;

class ProdutoFotoModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getByProduto(int $produtoId): array {
        try {
            $query = $this->db->prepare("
                SELECT * FROM produto_foto 
                WHERE produto_fk = :produto_fk AND active = TRUE
                ORDER BY is_primary DESC, produto_foto_id
            ");
            $query->execute([':produto_fk' => $produtoId]);
            return $query->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            error_log("Database error in getByProduto: " . $e->getMessage());
            return [];
        }
    }
    
    public function getById(int $id): ?\stdClass {
        try {
            $query = $this->db->prepare("
                SELECT * FROM produto_foto 
                WHERE produto_foto_id = :id AND active = TRUE
            ");
            $query->execute([':id' => $id]);
            return $query->fetch(\PDO::FETCH_OBJ) ?: null;
        } catch (\PDOException $e) {
            error_log("Database error in getById: " . $e->getMessage());
            return null;
        }
    }
    
    public function create(array $fotoData): bool {
        try {
            $query = $this->db->prepare("
                INSERT INTO produto_foto (
                    file_name, 
                    file_path, 
                    file_size, 
                    mime_type, 
                    produto_fk, 
                    is_primary, 
                    created_by, 
                    created_at,
                    active
                ) VALUES (
                    :file_name, 
                    :file_path, 
                    :file_size, 
                    :mime_type, 
                    :produto_fk, 
                    :is_primary, 
                    :created_by, 
                    NOW(),
                    TRUE
                )
            ");
            
            return $query->execute([
                ':file_name' => $fotoData['file_name'],
                ':file_path' => $fotoData['file_path'],
                ':file_size' => $fotoData['file_size'],
                ':mime_type' => $fotoData['mime_type'],
                ':produto_fk' => $fotoData['produto_fk'],
                ':is_primary' => $fotoData['is_primary'] ?? false,
                ':created_by' => $fotoData['created_by'] ?? null
            ]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function delete(int $id): bool {
        try {
            // Soft delete approach
            $query = $this->db->prepare("
                UPDATE produto_foto 
                SET active = FALSE, updated_at = NOW() 
                WHERE produto_foto_id = :id
            ");
            return $query->execute([':id' => $id]);
        } catch (\PDOException $e) {
            error_log("Database error in delete: " . $e->getMessage());
            return false;
        }
    }
    
    public function setAsPrimary(int $fotoId, int $produtoId): bool {
        try {
            $this->db->beginTransaction();
            
            // Reset all primary flags for this product
            $resetQuery = $this->db->prepare("
                UPDATE produto_foto 
                SET is_primary = FALSE 
                WHERE produto_fk = :produto_fk
            ");
            $resetQuery->execute([':produto_fk' => $produtoId]);
            
            // Set new primary photo
            $setQuery = $this->db->prepare("
                UPDATE produto_foto 
                SET is_primary = TRUE 
                WHERE produto_foto_id = :foto_id AND produto_fk = :produto_fk
            ");
            $result = $setQuery->execute([
                ':foto_id' => $fotoId,
                ':produto_fk' => $produtoId
            ]);
            
            $this->db->commit();
            return $result;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Database error in setAsPrimary: " . $e->getMessage());
            return false;
        }
    }
    
    public function setNewPrimary(int $produtoId, int $excludeId = 0): bool {
        try {
            $query = $this->db->prepare("
                UPDATE produto_foto 
                SET is_primary = TRUE 
                WHERE produto_foto_id = (
                    SELECT produto_foto_id 
                    FROM produto_foto 
                    WHERE produto_fk = :produto_fk 
                    AND produto_foto_id != :exclude_id
                    AND active = TRUE
                    ORDER BY created_at DESC
                    LIMIT 1
                )
            ");
            return $query->execute([
                ':produto_fk' => $produtoId,
                ':exclude_id' => $excludeId ?? 0
            ]);
        } catch (\PDOException $e) {
            error_log("Database error in setNewPrimary: " . $e->getMessage());
            return false;
        }
    }
}