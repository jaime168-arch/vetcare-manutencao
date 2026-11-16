<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$titulo = 'Consultas';
$status = $_GET['status'] ?? '';

$sql = "SELECT c.*, a.nome AS animal FROM consultas c JOIN animais a ON a.id = c.animal_id";
$params = [];

if ($status !== '') {
    $sql .= " WHERE c.status = ?";
    $params[] = $status;
}

$sql .= " ORDER BY c.data_consulta DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

$badgeClass = [
    'Agendada'  => 'tag-warning',
    'Realizada' => 'tag-success',
    'Cancelada' => 'tag-danger',
];

include __DIR__ . '/../includes/header.php';
?>

<h1>Consultas</h1>
<p class="muted">Agenda e histórico de atendimentos.</p>

<div class="actions">
    <a class="btn" href="form.php">+ Nova consulta</a>
</div>

<section class="panel">
    <form method="get">
        <div class="field">
            <label>Filtrar por status</label>
            <select name="status">
                <option value="">Todos</option>
                <?php foreach (['Agendada', 'Realizada', 'Cancelada'] as $op): ?>
                    <option value="<?= $op ?>" <?= $status === $op ? 'selected' : '' ?>><?= $op ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="actions">
            <button type="submit">Filtrar</button>
            <?php if ($status !== ''): ?>
                <a class="btn secondary" href="index.php">Limpar filtro</a>
            <?php endif; ?>
        </div>
    </form>
</section>

<div class="panel table-wrap">
    <table>
        <thead>
            <tr>
                <th>Animal</th>
                <th>Data</th>
                <th>Veterinário</th>
                <th>Motivo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="6" class="empty">Nenhuma consulta encontrada para este filtro.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($r['animal']) ?></strong></td>
                        <td><?= date('d/m/Y H:i', strtotime($r['data_consulta'])) ?></td>
                        <td><?= htmlspecialchars($r['veterinario']) ?></td>
                        <td><?= htmlspecialchars($r['motivo']) ?></td>
                        <td>
                            <span class="tag <?= $badgeClass[$r['status']] ?? '' ?>">
                                <?= htmlspecialchars($r['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="form.php?id=<?= $r['id'] ?>">Editar</a> | 
                            <a href="excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Deseja realmente excluir esta consulta?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>