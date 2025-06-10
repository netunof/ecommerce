<?php
namespace Config;
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $host = 'localhost';
        $dbname = 'digi';
        $username = 'postgres';
        $password = 'postgres';
        
        try {
            $this->connection = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
    public static function lastId() {
        return self::$instance->connection->lastInsertId();
    }
    
}