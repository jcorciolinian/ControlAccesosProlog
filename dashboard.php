<?php include __DIR__ . '/includes/header.php'; ?>
<?php
$totalUsers = $pdo->query("SELECT COUNT(*) c FROM usuarios")->fetch()['c'];
$totalVisitors = $pdo->query("SELECT COUNT(*) c FROM visitantes")->fetch()['c'];
$inside = $pdo->query("SELECT COUNT(*) c FROM accesos WHERE estado_acceso='PERMITIDO' AND fecha_hora_salida IS NULL")->fetch()['c'];
$alerts = $pdo->query("SELECT COUNT(*) c FROM alertas WHERE estado='ABIERTA'")->fetch()['c'];
$recent = $pdo->query("SELECT * FROM v_accesos_detalle ORDER BY fecha_hora_ingreso DESC LIMIT 8")->fetchAll();
?>
<div class="header-row"><h1>Dashboard</h1><span>Monitoreo general de accesos</span></div>
<div class="grid"><div class="card stat"><h3><?= $totalUsers ?></h3><p>Usuarios</p></div><div class="card stat"><h3><?= $totalVisitors ?></h3><p>Visitantes</p></div><div class="card stat"><h3><?= $inside ?></h3><p>Dentro de la institución</p></div><div class="card stat"><h3><?= $alerts ?></h3><p>Alertas abiertas</p></div></div>
<div class="card"><h2>Últimos accesos</h2><table><tr><th>Persona</th><th>Tipo</th><th>Área</th><th>Ingreso</th><th>Estado</th><th>Método</th></tr>
<?php foreach($recent as $r): ?><tr><td><?= e($r['persona']) ?></td><td><?= e($r['tipo_persona']) ?></td><td><?= e($r['area'] ?? 'General') ?></td><td><?= e($r['fecha_hora_ingreso']) ?></td><td><span class="badge <?= $r['estado_acceso']=='PERMITIDO'?'badge-ok':'badge-no' ?>"><?= e($r['estado_acceso']) ?></span></td><td><?= e($r['metodo_validacion']) ?></td></tr><?php endforeach; ?>
</table></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
