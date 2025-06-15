<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class EnderecoModel 
{
    private PDO $db;
    
    public function __construct() 
    {
        $this->db = Database::getInstance();
    }
    
    public function findByClienteId(int $clienteId): ?object 
    {
        $query = $this->db->prepare("SELECT * FROM endereco WHERE cliente_fk = :cliente_id AND active = TRUE");
        $query->execute([':cliente_id' => $clienteId]);
        
        return $query->fetch(PDO::FETCH_OBJ) ?: null;
    }
    
    public function createOrUpdate(int $clienteId, array $data): bool 
    {
        try {
            // Verifica se já existe um endereço para este cliente
            $enderecoExistente = $this->findByClienteId($clienteId);
            
            if ($enderecoExistente) {
                // Atualiza o endereço existente
                $query = $this->db->prepare("
                    UPDATE endereco 
                    SET 
                        endereco_cep = :cep,
                        endereco_logradouro = :logradouro,
                        endereco_numero = :numero,
                        endereco_cidade = :cidade,
                        endereco_estado = :estado,
                        updated_at = NOW()
                    WHERE cliente_fk = :cliente_id
                ");
            } else {
                // Cria um novo endereço
                $query = $this->db->prepare("
                    INSERT INTO endereco (
                        cliente_fk,
                        endereco_cep,
                        endereco_logradouro,
                        endereco_numero,
                        endereco_cidade,
                        endereco_estado,
                        created_at,
                        active
                    ) VALUES (
                        :cliente_id,
                        :cep,
                        :logradouro,
                        :numero,
                        :cidade,
                        :estado,
                        NOW(),
                        TRUE
                    )
                ");
            }
            
            return $query->execute([
                ':cliente_id' => $clienteId,
                ':cep' => $data['cep'],
                ':logradouro' => $data['logradouro'],
                ':numero' => $data['numero'],
                ':cidade' => $data['cidade'],
                ':estado' => $data['estado']
            ]);
        } catch (PDOException $e) {
                echo $e->getMessage();
            return false;
        }
    }
}