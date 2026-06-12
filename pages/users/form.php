<?php include __DIR__ . '/../../includes/header.php'; require_permission('usuarios.crear');
$id=$_GET['id']??null; $user=['nombres'=>'','apellidos'=>'','documento'=>'','correo'=>'','username'=>'','estado'=>'ACTIVO','id_rol'=>''];
if($id){$st=$pdo->prepare("SELECT * FROM usuarios WHERE id_usuario=?");$st->execute([$id]);$user=$st->fetch();}
$roles=$pdo->query("SELECT * FROM roles ORDER BY nombre_rol")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=[trim($_POST['nombres']),trim($_POST['apellidos']),trim($_POST['documento']),trim($_POST['correo']),trim($_POST['username']),$_POST['estado'],$_POST['id_rol']];
    if($id){
        if($_POST['password']??''){ $hash=password_hash($_POST['password'], PASSWORD_DEFAULT); $pdo->prepare("UPDATE usuarios SET nombres=?,apellidos=?,documento=?,correo=?,username=?,estado=?,id_rol=?,password_hash=? WHERE id_usuario=?")->execute([...$data,$hash,$id]); }
        else { $pdo->prepare("UPDATE usuarios SET nombres=?,apellidos=?,documento=?,correo=?,username=?,estado=?,id_rol=? WHERE id_usuario=?")->execute([...$data,$id]); }
        log_event('ACTUALIZAR_USUARIO',"Usuario ID $id");
    } else {
        $hash=password_hash($_POST['password'] ?: 'Admin123*', PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO usuarios(nombres,apellidos,documento,correo,username,estado,id_rol,password_hash) VALUES(?,?,?,?,?,?,?,?)")->execute([...$data,$hash]);
        log_event('CREAR_USUARIO',"Usuario ".$_POST['username']);
    }
    flash('success','Usuario guardado.'); redirect('index.php');
} ?>
<h1><?= $id?'Editar':'Nuevo' ?> usuario</h1><div class="card"><form method="POST" class="two-col">
<div><label>Nombres</label><input name="nombres" value="<?= e($user['nombres']) ?>" required></div><div><label>Apellidos</label><input name="apellidos" value="<?= e($user['apellidos']) ?>" required></div>
<div><label>Documento</label><input name="documento" value="<?= e($user['documento']) ?>" required></div><div><label>Correo</label><input name="correo" value="<?= e($user['correo']) ?>"></div>
<div><label>Usuario</label><input name="username" value="<?= e($user['username']) ?>" required></div><div><label>Contraseña</label><input name="password" type="password" <?= $id?'':'required' ?>></div>
<div><label>Rol</label><select name="id_rol"><?php foreach($roles as $r): ?><option value="<?= $r['id_rol'] ?>" <?= $user['id_rol']==$r['id_rol']?'selected':'' ?>><?= e($r['nombre_rol']) ?></option><?php endforeach; ?></select></div>
<div><label>Estado</label><select name="estado"><option>ACTIVO</option><option <?= $user['estado']=='INACTIVO'?'selected':'' ?>>INACTIVO</option></select></div>
<div><button>Guardar</button> <a class="btn btn-secondary" href="index.php">Volver</a></div></form></div><?php include __DIR__ . '/../../includes/footer.php'; ?>
