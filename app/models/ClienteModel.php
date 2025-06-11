<?php
namespace App\Models;
use App\Config\Database;

class ClienteModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $query = $this->db->query("SELECT * FROM cliente ORDER BY cliente_nome");
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE cliente_id = :cliente_id");
        $query->execute([':cliente_id' => $id]);
        return $query->fetch(\PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO cliente (cliente_nome, cliente_cpf, cliente_email, cliente_telefone, created_at) 
        VALUES (:cliente_nome, :cliente_cpf, :cliente_email, :cliente_telefone, CURRENT_TIMESTAMP)");
        return $query->execute([
            ':cliente_nome' => $data['cliente_nome'],
            ':cliente_cpf' => $data['cliente_cpf'],
            ':cliente_email' => $data['cliente_email'],
            ':cliente_telefone' => $data['cliente_telefone']
        ]);
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE cliente 
        SET cliente_nome = :cliente_nome, cliente_cpf = :cliente_cpf, cliente_email = :cliente_email, cliente_telefone = :cliente_telefone, updated_at
        WHERE cliente_id = :cliente_id");
        return $query->execute([
            ':cliente_id' => $id,
            ':cliente_nome' => $data['cliente_nome'],
            ':cliente_cpf' => $data['cliente_cpf'],
            ':cliente_email' => $data['cliente_email'],
            ':cliente_telefone' => $data['cliente_telefone']
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM cliente WHERE cliente_id = :cliente_id");
        return $query->execute([':cliente_id' => $id]);
    }
    
}