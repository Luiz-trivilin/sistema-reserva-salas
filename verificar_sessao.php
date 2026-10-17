<?php
session_start();
if (!isset($_SESSION['idutilizador'])) {
    header('Location: _index.php');
    exit;
}
require_once __DIR__ . '/comum.php';
try {
    $users = consultarBD('SELECT tipo FROM utilizador WHERE numfuncionario = ? AND valido = 1', [(int)$_SESSION['idutilizador']]);
    if (count($users) !== 1 || (int)$users[0]['tipo'] !== (int)($_SESSION['tipo'] ?? -1)) {
        session_unset();
        session_destroy();
        http_response_code(403);
        exit('Sessão inválida ou conta desativada');
    }
} catch (Throwable $e) {
    http_response_code(503);
    exit('Não foi possível validar a sessão');
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
function validarCSRF(): void {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', (string)$_POST['csrf_token'])) {
        http_response_code(403);
        exit('Pedido inválido');
    }
}
