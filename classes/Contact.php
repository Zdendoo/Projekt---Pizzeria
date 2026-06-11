<?php
declare(strict_types=1);

class Contact {
    private PDO $db;
    private string $table = "kontakty";

    // Cez konštruktor si vypýtame pripojenie na databázu
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // [C]REATE - Uloženie novej správy z formulára
    public function create(string $meno, string $email, string $predmet, string $sprava): bool {
        $query = "INSERT INTO " . $this->table . " (meno, email, predmet, sprava) 
                  VALUES (:meno, :email, :predmet, :sprava)";
        
        $stmt = $this->db->prepare($query);

        // Ochrana pred SQL Injection pomocou bindovania parametrov
        $stmt->bindParam(":meno", $meno);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":predmet", $predmet);
        $stmt->bindParam(":sprava", $sprava);

        return $stmt->execute();
    }

    // [R]EAD - Zobrazenie všetkých správ v administrácii
    public function getAll(): array {
        // OPRAVA: SQL dopyt upravený tak, aby ťahal nový stĺpec 'datum' namiesto starého s medzerou
        $query = "SELECT id, meno, email, predmet, sprava, datum FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // [U]PDATE - Úprava správy (napr. ak chce administrátor opraviť text alebo pridať poznámku)
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

    // [D]ELETE - Vymazanie správy z databázy
    public function delete(int $id): bool {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}