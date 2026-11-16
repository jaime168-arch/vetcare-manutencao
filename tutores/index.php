<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$titulo = 'Tutores';
$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $sql = "SELECT * FROM tutores WHERE nome LIKE ? ORDER BY nome";
    $param = ['%' . $busca . '%'];
} else {
    $sql = "SELECT * FROM tutores ORDER BY nome";
    $param = [];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($param);
$rows = $stmt->fetchAll();

include __DIR__ . '/../includes/header.php';
?>

<h1>Tutores</h1>
<p class="muted">Cadastro e consulta de responsáveis pelos animais.</p>

<div class="actions">
    <a class="btn" href="form.php">+ Novo tutor</a>
</div>

<section class="panel">
    <form method="get">
        <div class="field">
            <label>Buscar tutor</label>
            <input name="busca" placeholder="Digite o nome completo ou parcial" value="<?= htmlspecialchars($busca) ?>">
        </div>
        <div class="actions">
            <button type="submit">Buscar</button>
            <?php if ($busca !== ''): ?>
                <a class="btn secondary" href="index.php">Limpar filtro</a>
            <?php endif; ?>
        </div>
    </form>
</section>

<div class="panel table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="5" class="empty">Nenhum tutor encontrado para a busca informada.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($r['nome']) ?></strong></td>
                        <td><?= htmlspecialchars($r['telefone']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td>
                            <span class="tag <?= $r['ativo'] ? 'tag-success' : 'tag-danger' ?>">
                                <?= $r['ativo'] ? 'Ativo' : 'Inativo' ?>
                            </span>
                        </td>
                        <td>
                            <a href="form.php?id=<?= $r['id'] ?>">Editar</a> | 
                            <a href="excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Deseja realmente excluir este tutor?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>