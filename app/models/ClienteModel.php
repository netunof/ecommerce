<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class ClienteModel 
{
    private PDO $db;
    
    public function __construct() 
    {
        $this->db = Database::getInstance();
    }
    
    public function getAll(): array 
    {
        $query = $this->db->query("SELECT * FROM cliente WHERE active = TRUE ORDER BY cliente_nome");
        return $query->fetchAll(PDO::FETCH_OBJ) ?: [];
    }
    
    public function find(int $id): ?object 
    {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE cliente_id = :id AND active = TRUE");
        $query->execute([':id' => $id]);
        
        return $query->fetch(PDO::FETCH_OBJ) ?: null;
    }
    
    public function findByEmail(string $email): ?object 
    {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE cliente_email = :email AND active = TRUE");
        $query->execute([':email' => $email]);
        
        return $query->fetch(PDO::FETCH_OBJ) ?: null;
    }
    
    public function create(array $data): bool 
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO cliente (
                    cliente_nome, 
                    cliente_cpf, 
                    cliente_email, 
                    cliente_telefone,
                    cliente_senha,
                    created_at,
                    active
                ) VALUES (
                    :nome, 
                    :cpf, 
                    :email, 
                    :telefone,
                    :senha,
                    NOW(),
                    TRUE
                )
            ");
            
            return $query->execute([
                ':nome' => $data['cliente_nome'],
                ':cpf' => $data['cliente_cpf'],
                ':email' => $data['cliente_email'],
                ':telefone' => $data['cliente_telefone'],
                ':senha' => $data['cliente_senha'] ?? null
            ]);
        } catch (PDOException $e) {
            error_log("Database error in ClienteModel::create: " . $e->getMessage());
            return false;
        }
    }
    
    public function update(int $id, array $data): bool 
    {
        try {
            $queryString = "
                UPDATE cliente 
                SET 
                    cliente_nome = :nome,
                    cliente_cpf = :cpf,
                    cliente_email = :email,
                    cliente_telefone = :telefone,
                    updated_at = NOW()
            ";
            
            // Senha vazia
            if (!empty($data['cliente_senha'])) {
                $queryString .= ", cliente_senha = :senha";
                $data['senha'] = $data['cliente_senha'];
            }
            
            $queryString .= " WHERE cliente_id = :id";
            
            $query = $this->db->prepare($queryString);
            
            $params = [
                ':id' => $id,
                ':nome' => $data['cliente_nome'],
                ':cpf' => $data['cliente_cpf'],
                ':email' => $data['cliente_email'],
                ':telefone' => $data['cliente_telefone']
            ];
            //Senha vazia
            if (!empty($data['cliente_senha'])) {
                $params[':senha'] = $data['cliente_senha'];
            }
            
            return $query->execute($params);
        } catch (PDOException $e) {
            error_log("Database error in ClienteModel::update: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete(int $id): bool 
    {
        try {
            // Soft delete
            $query = $this->db->prepare("
                UPDATE cliente 
                SET active = FALSE, updated_at = NOW() 
                WHERE cliente_id = :id
            ");
            return $query->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Database error in ClienteModel::delete: " . $e->getMessage());
            return false;
        }
    }
    
    public function authenticate(string $email, string $password): ?object 
    {
        $cliente = $this->findByEmail($email);
        
        if ($cliente && password_verify($password, $cliente->cliente_senha ?? '')) {
            return $cliente;
        }
        
        return null;
    }
    
    public function updatePassword(int $id, string $newPassword): bool
    {
        try {
            $query = $this->db->prepare("
                UPDATE cliente 
                SET cliente_senha = :senha, updated_at = NOW()
                WHERE cliente_id = :id
            ");
            
            return $query->execute([
                ':id' => $id,
                ':senha' => password_hash($newPassword, PASSWORD_DEFAULT)
            ]);
        } catch (PDOException $e) {
            error_log("Database error in ClienteModel::updatePassword: " . $e->getMessage());
            return false;
        }
    }
    public function lastInsertId(){
        return Database::lastId();
    }
}