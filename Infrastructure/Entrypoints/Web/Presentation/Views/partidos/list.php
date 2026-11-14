<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de partidos políticos</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (empty($partidos)): ?>
    <p>No hay partidos políticos registrados todav��a.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Eslogan</th>
                <th>Presidente</th>
                <th>Secretario</th>
                <th>Tesorero</th>
                <th>País</th>
                <th>Número de presidentes</th>
                <th>Número de gobernadores</th>
                <th>Número de alcaldes</th>
                <th>Número de concejales</th>
                <th>Número de congresistas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <tr>
                    <td class="col-id"><?= htmlspecialchars($partido['id'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['eslogan'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['presidente'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['secretario'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['tesorero'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($partido['pais'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-num"><?= htmlspecialchars($partido['num_presidentes'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-num"><?= htmlspecialchars($partido['num_gobernadores'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-num"><?= htmlspecialchars($partido['num_alcaldes'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-num"><?= htmlspecialchars($partido['num_concejales'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-num"><?= htmlspecialchars($partido['num_congresistas'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=partidos.show&id=<?= urlencode($partido['id']) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=partidos.edit&id=<?= urlencode($partido['id']) ?>">Editar</a>
                        <form method="POST" action="?route=partidos.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars($partido['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($partido['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p>
    <a class="btn btn-primary" href="?route=partidos.create">Registrar nuevo partido</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>