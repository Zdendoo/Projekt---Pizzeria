<?php
declare(strict_types=1);

require_once 'classes/Database.php';
require_once 'classes/Pizza.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $pizzaManager = new Pizza($db);

    $nazov = trim($_POST['nazov'] ?? '');
    $popis = trim($_POST['popis'] ?? '');
    $obrazok = trim($_POST['obrazok'] ?? '');
    $cena = (float)($_POST['cena'] ?? 0.0);

    if (!empty($nazov) && !empty($popis) && !empty($obrazok) && $cena > 0) {
        if ($pizzaManager->create($nazov, $popis, $obrazok, $cena)) {
            header("Location: admin.php?status=success");
            exit();
        } else {
            $error = 'Chyba pri ukladaní.';
        }
    } else {
        $error = 'Vyplňte všetky polia.';
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Pridať Pizzu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>body{ padding: 40px; }</style>
</head>
<body>
<div class="container" style="max-width: 600px;">
    <h2>Pridať pizzu do ponuky</h2>
    <hr>
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="add_pizza.php" method="post">
        <div class="form-group">
            <label>Názov pizze</label>
            <input type="text" name="nazov" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Popis</label>
            <textarea name="popis" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Obrázok</label>
            <input type="text" name="obrazok" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Cena</label>
            <input type="number" name="cena" step="0.01" class="form-control" required>
        </div>
        <input type="submit" class="btn btn-success" value="Uložiť pizzu">
        <a href="admin.php" class="btn btn-default">Zrušiť</a>
    </form>
</div>
</body>
</html>