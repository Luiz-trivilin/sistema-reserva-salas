<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if ((int)($_SESSION['tipo'] ?? -1) !== 2) { http_response_code(403); exit('Sem permissão'); }
$id = filter_input(INPUT_POST,'id_marcacao',FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('ID inválido'); }
consultarBD('DELETE FROM marcacao WHERE id=?',[$id]);
header('Location: ver_marcacao.php'); exit;
