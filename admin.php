<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Pizza.php';
require_once 'classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$pizzaManager = new Pizza($db);
$contactManager = new Contact($db);

$pizzas = $pizzaManager->getAll();
$messages = $contactManager->getAll();
?>

<?php include 'parts/head.php'; ?>

<body id="admin-page" style="background-color: #fafafa;">

<?php include 'parts/header.php'; ?>

    <section id="admin-pizzas" class="templatemo-section templatemo-top-130">
        <div class="container">
            
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12 text-center">
                    <h1 class="text-uppercase" style="font-family: 'Chewy', cursive; color: #f39c12; font-size: 3.5em; margin-bottom: 5px;">
                        Admin Panel
                    </h1>
                    <p style="font-size: 1.2em; color: #666;"></p>
                    <hr style="border-top: 2px solid #f39c12; width: 100px; margin: 20px auto;">
                    <div style="margin-top: -10px; margin-bottom: 30px; text-align: center;">
                        <a href="logout.php" class="btn btn-danger" style="font-weight: bold; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">Odhlásiť sa</a>
                    </div>
                </div>
            </div>

            <?php if(isset($_GET['status'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success text-center" style="font-weight: 600; border-radius: 4px; border-color: #d6e9c6;">
                            <i class="fa fa-check-circle"></i> operacia bola uspesna
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="clearfix" style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <h3 class="pull-left text-uppercase" style="margin: 5px 0 0 0; font-weight: 600; color: #333;">
                            <i class="fa fa-pie-chart" style="color: #f39c12;"></i> Ponuka pízz
                        </h3>
                        <a href="add_pizza.php" class="btn btn-warning pull-right" style="background-color: #f39c12; border-color: #f39c12; color: #fff; font-weight: 600;">
                            <i class="fa fa-plus"></i> Pridať novú pizzu
                        </a>
                    </div>

                    <div class="table-responsive" style="background: #fff; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <table class="table table-striped" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background-color: #f39c12; color: #fff;">
                                    <th style="padding: 12px;">Obrázok</th>
                                    <th style="padding: 12px;">Názov</th>
                                    <th style="padding: 12px;">Popis</th>
                                    <th style="padding: 12px;">Cena</th>
                                    <th style="padding: 12px; text-align: center;">Zmena</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($pizzas)): ?>
                                <tr><td colspan="5" class="text-center" style="padding: 20px; color: #999;">Žiadne pizze v databáze.</td></tr>
                            <?php else: ?>
                                <?php foreach($pizzas as $pizza): ?>
                                    <tr>
                                        <td style="width: 100px; vertical-align: middle; padding: 12px;">
                                            <img src="images/<?= htmlspecialchars($pizza['obrazok']) ?>" class="img-responsive img-thumbnail" style="max-height: 60px; display: block; margin: 0 auto;">
                                        </td>
                                        <td style="vertical-align: middle; padding: 12px;">
                                            <strong style="font-size: 1.1em; color: #333;"><?= htmlspecialchars($pizza['nazov']) ?></strong>
                                        </td>
                                        <td style="vertical-align: middle; padding: 12px; color: #666; max-width: 350px;">
                                            <?= htmlspecialchars($pizza['popis']) ?>
                                        </td>
                                        <td style="vertical-align: middle; padding: 12px; font-weight: bold; color: #f39c12; font-size: 1.1em;">
                                            <?= number_format((float)$pizza['cena'], 2, ',', ' ') ?> €
                                        </td>
                                        <td style="width: 200px; vertical-align: middle; text-align: center; padding: 12px;">
                                            <a href="edit_pizza.php?id=<?= $pizza['id'] ?>" class="btn btn-default btn-sm" style="margin-right: 5px; border-color: #ccc;">
                                                <i class="fa fa-pencil" style="color: #f39c12;"></i> Upraviť
                                            </a>
                                            <a href="delete_pizza.php?id=<?= $pizza['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Naozaj vymazať túto pizzu?')" style="background-color: #f39c12;">
                                                <i class="fa fa-trash"></i> Zmazať
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="admin-messages" class="templatemo-section templatemo-light-gray-bg" style="border-top: 1px solid #eee;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <h3 class="text-uppercase" style="margin: 0; font-weight: 600; color: #333;">
                            <i class="fa fa-envelope" style="color: #f39c12;"></i> Prijaté správy od zákazníkov
                        </h3>
                    </div>
                    
                    <div class="table-responsive" style="background: #fff; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <table class="table table-striped" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background-color: #f39c12; color: #fff;">
                                    <th style="padding: 12px; width: 160px;">Dátum</th>
                                    <th style="padding: 12px; width: 180px;">Meno</th>
                                    <th style="padding: 12px; width: 220px;">Email</th>
                                    <th style="padding: 12px; width: 200px;">Predmet</th>
                                    <th style="padding: 12px;">Správa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($messages)): ?>
                                <tr><td colspan="5" class="text-center" style="padding: 20px; color: #999;">Žiadne správy.</td></tr>
                            <?php else: ?>
                                <?php foreach($messages as $msg): ?>
                                    <tr>
                                        <td style="vertical-align: top; padding: 12px; font-size: 0.9em; color: #777;">
                                            <i class="fa fa-clock-o"></i> <?= htmlspecialchars($msg['datum odoslania'] ?? $msg['datum'] ?? 'Neznámy') ?>
                                        </td>
                                        <td style="vertical-align: top; padding: 12px;">
                                            <strong><?= htmlspecialchars($msg['meno']) ?></strong>
                                        </td>
                                        <td style="vertical-align: top; padding: 12px;">
                                            <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color: #f39c12; font-weight: 500;">
                                                <i class="fa fa-envelope-o"></i> <?= htmlspecialchars($msg['email']) ?>
                                            </a>
                                        </td>
                                        <td style="vertical-align: top; padding: 12px; font-weight: 600; color: #444;">
                                            <?= htmlspecialchars($msg['predmet']) ?>
                                        </td>
                                        <td style="vertical-align: top; padding: 12px; color: #555; white-space: pre-line; max-width: 400px;">
                                            <?= nl2br(htmlspecialchars($msg['sprava'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php include 'parts/footer.php'; ?>
<?php include 'parts/script.php'; ?>

</body>
</html>