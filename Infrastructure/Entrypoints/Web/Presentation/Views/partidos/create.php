<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar partido político</h1>

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

<form method="POST" action="?route=partidos.store">

    <div class="form-group">
        <label for="id">ID</label><br>
        <input type="text" id="id" name="id"
            value="<?= htmlspecialchars((string) ($old['id'] ?? (function_exists('generateUuid4') ? generateUuid4() : '')), ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre"
            value="<?= htmlspecialchars($old['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['nombre'])): ?>
            <div class="field-error">
                <?= htmlspecialchars($errors['nombre'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="eslogan">Eslogan</label><br>
        <input type="text" id="eslogan" name="eslogan"
            value="<?= htmlspecialchars($old['eslogan'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['eslogan'])): ?>
            <div class="field-error">
                <?= htmlspecialchars($errors['eslogan'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="presidente">Presidente</label><br>
        <input type="text" id="presidente" name="presidente"
            value="<?= htmlspecialchars($old['presidente'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="secretario">Secretario</label><br>
        <input type="text" id="secretario" name="secretario"
            value="<?= htmlspecialchars($old['secretario'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="tesorero">Tesorero</label><br>
        <input type="text" id="tesorero" name="tesorero"
            value="<?= htmlspecialchars($old['tesorero'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="pais">País</label><br>
        <input type="text" id="pais" name="pais"
            value="<?= htmlspecialchars($old['pais'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="num_presidentes">Número de presidentes</label><br>
        <input type="number" id="num_presidentes" name="num_presidentes"
            value="<?= htmlspecialchars($old['num_presidentes'] ?? 0, ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="num_gobernadores">Número de gobernadores</label><br>
        <input type="number" id="num_gobernadores" name="num_gobernadores"
            value="<?= htmlspecialchars($old['num_gobernadores'] ?? 0, ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="num_alcaldes">Número de alcaldes</label><br>
        <input type="number" id="num_alcaldes" name="num_alcaldes"
            value="<?= htmlspecialchars($old['num_alcaldes'] ?? 0, ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="num_concejales">Número de concejales</label><br>
        <input type="number" id="num_concejales" name="num_concejales"
            value="<?= htmlspecialchars($old['num_concejales'] ?? 0, ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="num_congresistas">Número de congresistas</label><br>
        <input type="number" id="num_congresistas" name="num_congresistas"
            value="<?= htmlspecialchars($old['num_congresistas'] ?? 0, ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <button type="submit" class="btn btn-primary">Registrar partido político</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>