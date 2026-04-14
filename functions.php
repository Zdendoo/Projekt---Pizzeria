<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "pizzadatabaza";

    $conn = new mysqli($host, $user, $pass, $db);

    $meno = $_POST['name'];
    $email = $_POST['email'];
    $predmet = $_POST['subject'];
    $sprava = $_POST['message'];

    $sql = "INSERT INTO kontakty (meno, email, predmet, sprava) 
            VALUES ('$meno', '$email', '$predmet', '$sprava')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Chyba: " . $conn->error;
    }
    
    $conn->close();
} else { 
    header("Location: index.php");
}
?>