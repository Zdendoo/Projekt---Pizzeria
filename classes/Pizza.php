<?php
declare(strict_types=1);

class Pizza {
    private PDO $db;
    private string $table = "pizze";

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // [R]EAD - Získanie všetkých pízz pre galériu
    public function getAll(): array {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // [R]EAD - Získanie jednej konkrétnej pizze (budeš potrebovať pri editácii)
    public function getById(int $id): ?array {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result : null;
    }

    // [C]REATE - Pridanie novej pizze adminom
    public function create(string $nazov, string $popis, string $obrazok, float $cena): bool {
        $query = "INSERT INTO " . $this->table . " (nazov, popis, obrazok, cena) 
                  VALUES (:nazov, :popis, :obrazok, :cena)";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(":nazov", $nazov);
        $stmt->bindParam(":popis", $popis);
        $stmt->bindParam(":obrazok", $obrazok);
        $stmt->bindParam(":cena", $cena);
        
        return $stmt->execute();
    }

    // [U]PDATE - Úprava existujúcej pizze adminom
    public function update(int $id, string $nazov, string $popis, string $obrazok, float $cena): bool {
        $query = "UPDATE " . $this->table . " 
                  SET nazov = :nazov, popis = :popis, obrazok = :obrazok, cena = :cena 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nazov", $nazov);
        $stmt->bindParam(":popis", $popis);
        $stmt->bindParam(":obrazok", $obrazok);
        $stmt->bindParam(":cena", $cena);
        
        return $stmt->execute();
    }

    // [D]ELETE - Vymazanie pizze adminom
    public function delete(int $id): bool {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}