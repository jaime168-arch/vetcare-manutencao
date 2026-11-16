<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$titulo = $titulo ?? 'VetCare';

$em_subpasta = file_exists('../assets/style.css');
$prefixo = $em_subpasta ? '../' : './';
$uri = $_SERVER['REQUEST_URI'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($titulo) ?> | VetCare</title>
<link rel="stylesheet" href="<?= $prefixo ?>assets/style.css">
</head>
<body>
<header class="topbar">
  <a class="brand" href="<?= $prefixo ?>index.php">🐾 VetCare</a>
  <nav>
    <?php if (!empty($_SESSION['usuario_id'])): ?>
      <a href="<?= $prefixo ?>index.php" class="<?= str_ends_with(parse_url($uri, PHP_URL_PATH), '/index.php') && !$em_subpasta ? 'active' : '' ?>">Painel</a>
      <a href="<?= $prefixo ?>tutores/index.php" class="<?= str_contains($uri, '/tutores/') ? 'active' : '' ?>">Tutores</a>
      <a href="<?= $prefixo ?>animais/index.php" class="<?= str_contains($uri, '/animais/') ? 'active' : '' ?>">Animais</a>
      <a href="<?= $prefixo ?>consultas/index.php" class="<?= str_contains($uri, '/consultas/') ? 'active' : '' ?>">Consultas</a>
      <a href="<?= $prefixo ?>chamados/index.php" class="<?= str_contains($uri, '/chamados/') ? 'active' : '' ?>">Suporte</a>
      <a href="<?= $prefixo ?>logout.php">Sair</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">