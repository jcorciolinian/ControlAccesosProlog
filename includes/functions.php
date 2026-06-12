<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/../config/database.php';

function e($value){ return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function redirect($url){ header("Location: $url"); exit; }
function current_user(){ return $_SESSION['user'] ?? null; }
function is_logged(){ return isset($_SESSION['user']); }
function base_url($path=''){ return '/prolog_access_system_final/' . ltrim($path, '/'); }

function require_login(){ if (!is_logged()) { redirect(base_url('login.php')); } }
function has_permission($perm){
    $user = current_user();
    if (!$user) return false;
    if (($user['role_name'] ?? '') === 'Administrador') return true;
    return in_array($perm, $_SESSION['permissions'] ?? []);
}
function require_permission($perm){
    if (!has_permission($perm)) {
        include __DIR__ . '/header.php';
        echo "<div class='card'><h2>Acceso restringido</h2><p>No tienes permiso para acceder a este módulo.</p></div>";
        include __DIR__ . '/footer.php';
        exit;
    }
}
function log_event($action, $description = ''){
    global $pdo;
    try{
        $uid = $_SESSION['user']['id_usuario'] ?? null;
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $stmt = $pdo->prepare("INSERT INTO bitacora(id_usuario, accion, descripcion, ip_origen) VALUES(?,?,?,?)");
        $stmt->execute([$uid, $action, $description, $ip]);
    }catch(Exception $e){}
}
function flash($type, $msg){ $_SESSION['flash'] = ['type'=>$type,'msg'=>$msg]; }
function show_flash(){
    if(isset($_SESSION['flash'])){
        $f = $_SESSION['flash']; unset($_SESSION['flash']);
        echo "<div class='alert alert-".e($f['type'])."'>".e($f['msg'])."</div>";
    }
}
function generate_qr_token($prefix='QR'){ return $prefix . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(4)); }
