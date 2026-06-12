<?php require_once __DIR__ . '/functions.php'; require_login(); ?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>PROLOG Access</title><link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"></head>
<body><div class="layout"><aside class="sidebar"><div class="brand">PROLOG Access <small>Sistema de control de accesos</small></div><nav class="nav">
<a href="<?= base_url('dashboard.php') ?>">Dashboard</a>
<?php if(has_permission('usuarios.ver')): ?><a href="<?= base_url('pages/users/index.php') ?>">Usuarios</a><?php endif; ?>
<?php if(has_permission('roles.ver')): ?><a href="<?= base_url('pages/roles/index.php') ?>">Roles y permisos</a><?php endif; ?>
<?php if(has_permission('visitantes.ver')): ?><a href="<?= base_url('pages/visitors/index.php') ?>">Visitantes</a><?php endif; ?>
<?php if(has_permission('accesos.ver')): ?><a href="<?= base_url('pages/access/index.php') ?>">Control de accesos</a><?php endif; ?>
<?php if(has_permission('areas.ver')): ?><a href="<?= base_url('pages/areas/index.php') ?>">Áreas restringidas</a><?php endif; ?>
<?php if(has_permission('alertas.ver')): ?><a href="<?= base_url('pages/alerts/index.php') ?>">Alertas</a><?php endif; ?>
<?php if(has_permission('reportes.ver')): ?><a href="<?= base_url('pages/reports/index.php') ?>">Reportes</a><?php endif; ?>
<?php if(has_permission('auditoria.ver')): ?><a href="<?= base_url('pages/audit/index.php') ?>">Bitácora</a><?php endif; ?>
<a href="<?= base_url('logout.php') ?>">Cerrar sesión</a></nav></aside>
<main class="main"><div class="topbar"><strong><?= e($_SESSION['user']['nombre_completo'] ?? 'Usuario') ?></strong><span><?= e($_SESSION['user']['role_name'] ?? '') ?></span></div><section class="content"><?php show_flash(); ?>
