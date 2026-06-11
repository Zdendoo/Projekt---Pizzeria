<?php
declare(strict_types=1);

// Načítame triedy
require_once 'classes/Database.php';
require_once 'classes/Contact.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    // Vytvorenie objektov
    $database = new Database();
    $db = $database->getConnection();
    $contactManager = new Contact($db);

    // Očistenie vstupov od neviditeľných znakov (Trim)
    $meno = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $predmet = trim($_POST['subject'] ?? '');
    $sprava = trim($_POST['message'] ?? '');

    // Jednoduchá validácia, či nie sú polia prázdne
    if (!empty($meno) && !empty($email) && !empty($predmet) && !empty($sprava)) {
        
        // Voláme OOP metódu na vytvorenie záznamu
        if ($contactManager->create($meno, $email, $predmet, $sprava)) {
            // Úspešne odoslané, presmerujeme späť na index
            header("Location: index.php?status=success");
            exit();
        } else {
            echo "Nastal problém pri ukladaní do databázy.";
        }
    } else {
        echo "Prosím, vyplňte všetky polia.";
    }
} else { 
    header("Location: index.php");
    exit();
}