<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class PedidoModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO pedido (
                    cliente_fk,
                    total,
                    created_at
                ) VALUES (
                    :cliente_fk,
                    :total,
                    NOW()
                ) RETURNING pedido_id
            ");

            $query->execute([
                ':cliente_fk' => $data['cliente_fk'],
                ':total' => $data['total']
            ]);

            return (int)$query->fetchColumn();
        } catch (PDOException $e) {
            error_log("Database error in PedidoModel::create: " . $e->getMessage());
            return 0;
        }
    }

    public function find(int $pedidoId): ?object
    {
        $query = $this->db->prepare("
        SELECT 
            p.pedido_id,
            p.cliente_fk as cliente_fk,
            p.total,
            p.created_at,
            p.active,
            c.cliente_nome,
            c.cliente_email,
            e.estado_nome
        FROM pedido p
        INNER JOIN cliente c ON p.cliente_fk = c.cliente_id
        INNER JOIN estado e ON p.estado_fk = e.estado_id
        WHERE p.pedido_id = :pedido_id AND p.active = TRUE
    ");
        
        $query->execute([':pedido_id' => $pedidoId]);
        
        return $query->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function findByCliente(int $clienteId): array
    {
        $query = $this->db->prepare("
            SELECT p.*, e.estado_nome
            FROM pedido p
            INNER JOIN estado e ON p.estado_fk = e.estado_id
            WHERE p.cliente_fk = :cliente_id AND p.active = TRUE
            ORDER BY p.created_at DESC
        ");
        
        $query->execute([':cliente_id' => $clienteId]);
        
        return $query->fetchAll(PDO::FETCH_OBJ) ?: [];
    }
}