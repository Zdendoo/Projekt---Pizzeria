<?php
declare(strict_types=1);

require_once 'classes/Database.php';
require_once 'classes/Pizza.php';

$database = new Database();
$db = $database->getConnection();
$pizzaManager = new Pizza($db);

$error = '';
$id = (int)($_GET['id'] ?? 0);


$pizza = $pizzaManager->getById($id);

if (!$pizza) {
    die("pizza s tymto ID neexistuje");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazov = trim($_POST['nazov'] ?? '');
    $popis = trim($_POST['popis'] ?? '');
    $obrazok = trim($_POST['obrazok'] ?? '');
    $cena = (float)($_POST['cena'] ?? 0.0);

    if (!empty($nazov) && !empty($popis) && !empty($obrazok) && $cena > 0) {
        if ($pizzaManager->update($id, $nazov, $popis, $obrazok, $cena)) {
            header("Location: admin.php?status=success");
            exit();
        } else {
            $error = 'Chyba pri aktualizácii databázy.';
        }
    } else {
        $error = 'Prosím, vyplňte všetky polia správne.';
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Upraviť Pizzu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>body{ padding: 40px; }</style>
</head>
<body>
<div class="container" style="max-width: 600px;">
    <h2>Upraviť pizzu: <?= htmlspecialchars($pizza['nazov']) ?></h2>
    <hr>
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="edit_pizza.php?id=<?= $id ?>" method="post">
        <div class="form-group">
            <label>Názov pizze</label>
            <input type="text" name="nazov" class="form-control" value="<?= htmlspecialchars($pizza['nazov']) ?>" required>
        </div>
        <div class="form-group">
            <label>Popis</label>
            <textarea name="popis" class="form-control" required><?= htmlspecialchars($pizza['popis']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Obrázok</label>
            <input type="text" name="obrazok" class="form-control" value="<?= htmlspecialchars($pizza['obrazok']) ?>" required>
        </div>
        <div class="form-group">
            <label>Cena</label>
            <input type="number" name="cena" step="0.01" class="form-control" value="<?= htmlspecialchars((string)$pizza['cena']) ?>" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Aktualizovať">
        <a href="admin.php" class="btn btn-default">Zrušiť</a>
    </form>
</div>
</body>
</html>