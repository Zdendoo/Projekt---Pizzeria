<?php
declare(strict_types=1);

class Database {
    private string $host = "localhost";
    private string $db_name = "pizzadatabaza";
    private string $username = "root";
    private string $password = "";
    private ?PDO $conn = null;

    public function getConnection(): PDO {
        if ($this->conn === null) {
            try {
                
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $exception) {
                die("Chyba pripojenia k databáze: " . $exception->getMessage());
            }
        }
        return $this->conn;
    }
}