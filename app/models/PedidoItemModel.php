<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class PedidoItemModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $data): bool
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO pedido_item (
                    produto_fk,
                    pedido_fk,
                    pedido_item_quantidade,
                    estado_fk,
                    created_at
                ) VALUES (
                    :produto_fk,
                    :pedido_fk,
                    :pedido_item_quantidade,
                    :estado_fk,
                    NOW()
                )
            ");

            return $query->execute([
                ':produto_fk' => $data['produto_fk'],
                ':pedido_fk' => $data['pedido_fk'],
                ':pedido_item_quantidade' => $data['pedido_item_quantidade'],
                ':estado_fk' => 2 // Realizado
            ]);
        } catch (PDOException $e) {
            error_log("Database error in PedidoItemModel::create: " . $e->getMessage());
            return false;
        }
    }

    public function getByPedido(int $pedidoId): array
    {
        $query = $this->db->prepare("
            SELECT pi.*, p.produto_nome, p.produto_preco, pf.file_path
            FROM pedido_item pi
            JOIN produto p ON pi.produto_fk = p.produto_id
            LEFT JOIN produto_foto pf ON pf.produto_fk = p.produto_id AND pf.is_primary = TRUE
            WHERE pi.pedido_fk = :pedido_fk AND pi.active = TRUE
        ");
        
        $query->execute([':pedido_fk' => $pedidoId]);
        
        return $query->fetchAll(PDO::FETCH_OBJ) ?: [];
    }
}