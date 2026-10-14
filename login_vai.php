<?php
require_once 'comum.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
$user = strtolower(trim((string)($_POST['utilizador'] ?? '')));
$pass = (string)($_POST['pass'] ?? '');
$rs = consultarBD('SELECT password,tipo,numfuncionario FROM utilizador WHERE nomecompleto = ?', [$user]);
if (count($rs) === 1 && password_verify($pass, $rs[0]['password'])) {
    session_regenerate_id(true);
    $_SESSION['idutilizador'] = $rs[0]['numfuncionario'];
    $_SESSION['tipo'] = $rs[0]['tipo'];
    header('Location: calendario.php'); exit;
}
header('Location: _index.php?erro=1'); exit;
