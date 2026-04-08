<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meno = $_POST['name'];
    $email = $_POST['email'];
    $predmet = $_POST['subject'];
    $sprava = $_POST['message'];

    echo "<h1>Dáta z formulára:</h1>";
    echo "<b>Meno:</b> " . $meno . "<br>";
    echo "<b>Email:</b> " . $email . "<br>";
    echo "<b>Predmet:</b> " . $predmet . "<br>";
    echo "<b>Správa:</b> " . $sprava . "<br>";
    echo "<hr>";
    echo "<a href='index.php'>Naspäť na úvodnú stránku</a>";

} else { 
    header("Location: index.php");
}
?>