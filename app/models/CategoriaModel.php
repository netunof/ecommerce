<?php
require_once "config/database.php";

class Categoria {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $query = $this->db->query("SELECT * FROM categoria ORDER BY categoria_nome");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM categoria WHERE categoria_id = :categoria_id");
        $query->execute([':categoria_id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO categoria (categoria_nome, created_at) 
        VALUES (:categoria_nome, CURRENT_TIMESTAMP)");
        return $query->execute([
            ':categoria_nome' => $data['categoria_nome']
        ]);
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE categoria 
        SET categoria_nome = :categoria_nome
        WHERE categoria_id = :categoria_id");
        return $query->execute([
            ':categoria_id' => $id,
            ':categoria_nome' => $data
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM categoria WHERE categoria_id = :categoria_id");
        return $query->execute([':categoria_id' => $id]);
    }
    
}