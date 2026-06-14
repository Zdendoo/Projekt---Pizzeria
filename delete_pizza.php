<?php
declare(strict_types=1);

require_once 'classes/Database.php';
require_once 'classes/Pizza.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $database = new Database();
    $db = $database->getConnection();
    $pizzaManager = new Pizza($db);
    
    $pizzaManager->delete($id);
}

header("Location: admin.php?status=success");
exit();