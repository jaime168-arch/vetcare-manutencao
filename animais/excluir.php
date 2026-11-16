<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php?msg=excluido');
        exit;
    } catch (PDOException $e) {
        header('Location: index.php?erro=vinculo');
        exit;
    }
}

header('Location: index.php');
exit;