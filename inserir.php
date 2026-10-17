<?php
require_once 'comum.php';
require_once 'verificar_sessao.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if ((int)($_SESSION['tipo'] ?? -1) !== 0) { http_response_code(403); exit('Sem permissão'); }
validarCSRF();
$user = strtolower(trim((string)($_POST['utilizador'] ?? '')));
$pass = (string)($_POST['pass'] ?? '');
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_VALIDATE_INT);
if ($user === '' || strlen($pass) < 8 || !in_array($tipo, [0,1,2], true)) { http_response_code(400); exit('Dados inválidos'); }
consultarBD('INSERT INTO utilizador (nomecompleto,password,tipo) VALUES (?,?,?)', [$user,password_hash($pass, PASSWORD_DEFAULT),$tipo]);
header('Location: index.php'); exit;
