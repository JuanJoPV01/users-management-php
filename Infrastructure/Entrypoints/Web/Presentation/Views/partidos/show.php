<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de partido político</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td><?= htmlspecialchars($partido['id'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?= htmlspecialchars($partido['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Eslogan</th>
        <td><?= htmlspecialchars($partido['eslogan'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Presidente</th>
        <td><?= htmlspecialchars($partido['presidente'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Secretario</th>
        <td><?= htmlspecialchars($partido['secretario'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Tesorero</th>
        <td><?= htmlspecialchars($partido['tesorero'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>País</th>
        <td><?= htmlspecialchars($partido['pais'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Número de presidentes</th>
        <td><?= htmlspecialchars($partido['num_presidentes'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Número de gobernadores</th>
        <td><?= htmlspecialchars($partido['num_gobernadores'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Número de alcaldes</th>
        <td><?= htmlspecialchars($partido['num_alcaldes'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Número de concejales</th>
        <td><?= htmlspecialchars($partido['num_concejales'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Número de congresistas</th>
        <td><?= htmlspecialchars($partido['num_congresistas'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=partidos.edit&id=<?= urlencode($partido['id']) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=partidos.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>