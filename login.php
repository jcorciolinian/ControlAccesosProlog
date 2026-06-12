<?php
require_once __DIR__ . '/includes/functions.php';
if (is_logged()) redirect(base_url('dashboard.php'));
$error = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT u.*, r.nombre_rol AS role_name FROM usuarios u JOIN roles r ON r.id_rol=u.id_rol WHERE u.username=? LIMIT 1");
    $stmt->execute([$username]); $user = $stmt->fetch();
    if($user && $user['estado'] === 'ACTIVO' && password_verify($password, $user['password_hash'])){
        $_SESSION['user'] = ['id_usuario'=>$user['id_usuario'],'username'=>$user['username'],'nombre_completo'=>$user['nombres'].' '.$user['apellidos'],'role_name'=>$user['role_name'],'id_rol'=>$user['id_rol']];
        $pstmt = $pdo->prepare("SELECT p.codigo FROM permisos p JOIN rol_permiso rp ON rp.id_permiso=p.id_permiso WHERE rp.id_rol=?");
        $pstmt->execute([$user['id_rol']]); $_SESSION['permissions'] = array_column($pstmt->fetchAll(), 'codigo');
        log_event('LOGIN', 'Inicio de sesión exitoso'); redirect(base_url('dashboard.php'));
    } else { $error = "Credenciales inválidas o usuario inactivo."; }
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>PROLOG Access - Login</title><link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"></head>
<body class="login-bg"><div class="login-card"><div class="logo">🛡️ PROLOG Access</div><div class="subtitle">Sistema de control de accesos institucional</div>
<?php if($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="POST"><div class="form-group"><label>Usuario</label><input name="username" required autofocus></div><div class="form-group"><label>Contraseña</label><input name="password" type="password" required></div><button style="width:100%">Ingresar</button><p class="footer-note">Demo: admin / Admin123*</p></form></div></body></html>
