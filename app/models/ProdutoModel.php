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
    
    public function getProdutosComFoto($data) 
    {
        // Construir a query base
        $query = "SELECT p.*, f.file_path 
            FROM produto p 
            LEFT JOIN (
                SELECT pf.* FROM produto_foto pf 
                WHERE pf.produto_foto_id = COALESCE(
                    (SELECT pf2.produto_foto_id FROM produto_foto pf2 
                    WHERE pf2.produto_fk = pf.produto_fk AND pf2.is_primary = TRUE 
                    LIMIT 1),
                    (SELECT MIN(pf3.produto_foto_id) FROM produto_foto pf3 
                    WHERE pf3.produto_fk = pf.produto_fk)
                )
            ) f ON f.produto_fk = p.produto_id
            WHERE (p.produto_nome LIKE '%' || :produto_nome || '%' OR :produto_nome = '')
            AND (p.produto_preco BETWEEN :preco_min AND :preco_max)";
        
        // Preparar parâmetros base
        $params = [
            ':produto_nome' => $data['produto_nome'] ?? '',
            ':preco_min' => (float)($data['preco_min'] ?? 0),
            ':preco_max' => (float)($data['preco_max'] ?? PHP_FLOAT_MAX)
        ];
        
        // Tratar filtro de marcas (pode ser array ou valor único)
        if (!empty($data['marca_fk'])) {
            if (is_array($data['marca_fk']) && count($data['marca_fk']) > 0) {
                $marcaIds = array_map('intval', $data['marca_fk']);
                $placeholders = [];
                foreach ($marcaIds as $index => $marcaId) {
                    $placeholder = ":marca_fk_$index";
                    $placeholders[] = $placeholder;
                    $params[$placeholder] = $marcaId;
                }
                $query .= " AND p.marca_fk IN (" . implode(',', $placeholders) . ")";
            } else {
                $query .= " AND p.marca_fk = :marca_fk";
                $params[':marca_fk'] = (int)$data['marca_fk'];
            }
        }
        
        // Tratar filtro de categorias (pode ser array ou valor único)
        if (!empty($data['categoria_fk'])) {
            if (is_array($data['categoria_fk']) && count($data['categoria_fk']) > 0) {
                $categoriaIds = array_map('intval', $data['categoria_fk']);
                $placeholders = [];
                foreach ($categoriaIds as $index => $categoriaId) {
                    $placeholder = ":categoria_fk_$index";
                    $placeholders[] = $placeholder;
                    $params[$placeholder] = $categoriaId;
                }
                $query .= " AND p.categoria_fk IN (" . implode(',', $placeholders) . ")";
            } else {
                $query .= " AND p.categoria_fk = :categoria_fk";
                $params[':categoria_fk'] = (int)$data['categoria_fk'];
            }
        }
        
        $query .= " ORDER BY p.produto_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    
    public function find($produtoId) {
        $query = $this->db->prepare("SELECT p.*, f.file_path FROM produto p 
        LEFT JOIN (
                SELECT pf.* FROM produto_foto pf 
                WHERE pf.produto_foto_id = COALESCE(
                    (SELECT pf2.produto_foto_id FROM produto_foto pf2 
                    WHERE pf2.produto_fk = pf.produto_fk AND pf2.is_primary = TRUE 
                    LIMIT 1),
                    (SELECT MIN(pf3.produto_foto_id) FROM produto_foto pf3 
                    WHERE pf3.produto_fk = pf.produto_fk)
                )
            ) f ON f.produto_fk = p.produto_id
        WHERE produto_id = :produto_id");
        
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