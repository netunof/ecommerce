<?php
require_once "config/database.php";

class Modelo {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $query = $this->db->query("SELECT * FROM modelo ORDER BY modelo_nome");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM modelo WHERE modelo_id = :modelo_id");
        $query->execute([':modelo_id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function create($data) {
        $query = $this->db->prepare("INSERT INTO modelo (modelo_id, modelo_nome) 
        VALUES (:modelo_id, :modelo_nome)");
        return $query->execute([
            ':modelo_id' => $data['modelo_id'],
            ':modelo_nome' => $data['modelo_nome']
        ]);
    }
    
    public function update($id, $data) {
        $query = $this->db->prepare("UPDATE modelos 
        SET modelo_nome = :modelo_nome
        WHERE modelo_id = :modelo_id");
        return $query->execute([
            ':modelo_id' => $id,
            ':modelo_nome' => $data['modelo_nome']
        ]);
    }
    
    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM modelo WHERE modelo_id = :modelo_id");
        return $query->execute([':modelo_id' => $id]);
    }
    
}