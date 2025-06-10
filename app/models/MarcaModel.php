<?php
namespace App\Models;

require_once "config/database.php";

class Marca {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $query = $this->db->query("SELECT * FROM marca ORDER BY marca_nome");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM marca WHERE marca_id = :marca_id");
        $query->execute([':marca_id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO marca (marca_nome, created_at) 
        VALUES (:marca_nome, CURRENT_TIMESTAMP)");
        return $query->execute([
            ':marca_nome' => $data['marca_nome']
        ]);
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE marca
        SET marca_nome = :marca_nome
        WHERE marca_id = :marca_id");
        return $query->execute([
            ':marca_id' => $id,
            ':marca_nome' => $data
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM marca WHERE marca_id = :marca_id");
        return $query->execute([':marca_id' => $id]);
    }
    
}