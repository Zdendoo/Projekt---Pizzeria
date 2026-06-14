<?php
declare(strict_types=1);

class Contact {
    private PDO $db;
    private string $table = "kontakty";

    
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    
    public function create(string $meno, string $email, string $predmet, string $sprava): bool {
        $query = "INSERT INTO " . $this->table . " (meno, email, predmet, sprava) 
                  VALUES (:meno, :email, :predmet, :sprava)";
        
        $stmt = $this->db->prepare($query);

        
        $stmt->bindParam(":meno", $meno);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":predmet", $predmet);
        $stmt->bindParam(":sprava", $sprava);

        return $stmt->execute();
    }

    
    public function getAll(): array {
        
        $query = "SELECT id, meno, email, predmet, sprava, datum FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function update(int $id, string $meno, string $email, string $predmet, string $sprava): bool {
        $query = "UPDATE " . $this->table . " 
                  SET meno = :meno, email = :email, predmet = :predmet, sprava = :sprava 
                  WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":meno", $meno);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":predmet", $predmet);
        $stmt->bindParam(":sprava", $sprava);

        return $stmt->execute();
    }

    
    public function delete(int $id): bool {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}