<?php declare(strict_types=1); ?>
<?php $authUser = $_SESSION['auth'] ?? null; ?>

<nav>
    <a href="?route=home">Inicio</a>
    <a href="?route=partidos.index">Partidos Políticos</a>
    <a href="?route=partidos.create">Registrar Partido</a>
    <?php if ($authUser): ?>
        <span style="margin: 0 10px; color:#555;">|</span>
        <a href="?route=users.create">Registrar usuario</a>
        <a href="?route=users.index">Listar usuarios</a>
        <span style="margin: 0 10px; color:#555;">|</span>
        <span style="color:#333;">👤 <?= htmlspecialchars($authUser['name'], ENT_QUOTES, 'UTF-8') ?></span>
        &nbsp;
        <a href="?route=auth.logout">Cerrar sesión</a>
    <?php else: ?>
        <span style="margin: 0 10px; color:#555;">|</span>
        <a href="?route=auth.login">Iniciar sesión</a>
        <a href="?route=auth.forgot">Recuperar contraseña</a>
    <?php endif; ?>
</nav>

<hr>