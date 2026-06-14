<?php
declare(strict_types=1);
session_start();

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: admin.php");
    exit();
}

$error = '';

$spravne_meno = "admin";
$spravne_heslo = "admin";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meno = trim($_POST['username'] ?? '');
    $heslo = trim($_POST['password'] ?? '');

    if ($meno === $spravne_meno && $heslo === $spravne_heslo) {
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Nespravne meno alebo heslo";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>prihlasovanie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body { background-color: #f9f9f9; padding-top: 100px; }
        .login-panel { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="login-panel">
        <h3 class="text-center" style="color: #e7a41a; font-weight: bold;">Prihlasovanie - Admin</h3>
        <hr>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label>Prihlasovacie meno</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label>Heslo</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning btn-block" style="background-color: #e7a41a; border: none; font-weight: bold;">Prihlásiť sa</button>
        </form>
    </div>
</div>

</body>
</html>