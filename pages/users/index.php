<?php include __DIR__ . '/../../includes/header.php'; require_permission('usuarios.ver');
$rows = $pdo->query("SELECT u.*, r.nombre_rol FROM usuarios u JOIN roles r ON r.id_rol=u.id_rol ORDER BY u.id_usuario DESC")->fetchAll(); ?>
<div class="header-row"><h1>Gestión de usuarios</h1><a class="btn" href="form.php">Nuevo usuario</a></div>
<div class="card"><table><tr><th>ID</th><th>Nombres</th><th>Documento</th><th>Usuario</th><th>Rol</th><th>Estado</th><th>Acciones</th></tr>
<?php foreach($rows as $r): ?><tr>
<td><?= e($r['id_usuario']) ?></td><td><?= e($r['nombres'].' '.$r['apellidos']) ?></td><td><?= e($r['documento']) ?></td><td><?= e($r['username']) ?></td><td><?= e($r['nombre_rol']) ?></td><td><?= e($r['estado']) ?></td>
<td><a class="btn btn-secondary" href="form.php?id=<?= $r['id_usuario'] ?>">Editar</a> <a class="btn btn-danger" onclick="return confirm('¿Desactivar?')" href="delete.php?id=<?= $r['id_usuario'] ?>">Desactivar</a></td></tr><?php endforeach; ?></table></div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
