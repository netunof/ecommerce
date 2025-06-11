<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class CategoriaModel 
{
    private \PDO $db;
    
    public function __construct() 
    {
        $this->db = Database::getInstance();
    }
    
    public function getAll(): array 
    {
        $query = $this->db->query("SELECT * FROM categoria ORDER BY categoria_nome");
        return $query->fetchAll(PDO::FETCH_OBJ) ?: [];
    }
    
    public function find(int $id): ?object 
    {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE categoria_id = :id");
        $query->execute([':id' => $id]);
        
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ?: null;
    }
    
    public function create(array $data): bool 
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO categoria (categoria_nome, created_at) 
                VALUES (:nome, NOW())
            ");
            
            return $query->execute([
                ':nome' => $data['categoria_nome'] ?? null
            ]);
        } catch (PDOException $e) {
            // Log error here
            return false;
        }
    }
    
    public function update(int $id, string $nome): bool 
    {
        try {
            $query = $this->db->prepare("
                UPDATE categoria 
                SET categoria_nome = :nome
                WHERE categoria_id = :id
            ");
            
            return $query->execute([
                ':id' => $id,
                ':nome' => $nome
            ]);
        } catch (PDOException $e) {
            // Log error here
            return false;
        }
    }
    
    public function delete(int $id): bool 
    {
        try {
            $query = $this->db->prepare("
                DELETE FROM categoria 
                WHERE categoria_id = :id
            ");
            
            return $query->execute([':id' => $id]);
        } catch (PDOException $e) {
            // Log error here
            return false;
        }
    }
}