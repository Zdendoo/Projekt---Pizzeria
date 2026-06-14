<?php
declare(strict_types=1);


require_once 'classes/Database.php';
require_once 'classes/Contact.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
   
    $database = new Database();
    $db = $database->getConnection();
    $contactManager = new Contact($db);

    
    $meno = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $predmet = trim($_POST['subject'] ?? '');
    $sprava = trim($_POST['message'] ?? '');

    
    if (!empty($meno) && !empty($email) && !empty($predmet) && !empty($sprava)) {
        
        
        if ($contactManager->create($meno, $email, $predmet, $sprava)) {
            
            header("Location: index.php?status=success");
            exit();
        } else {
            echo "chyba pri ukladani spravy...";
        }
    } else {
        echo "vyplnte vsetky polia.";
    }
} else { 
    header("Location: index.php");
    exit();
}