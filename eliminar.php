<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if (!in_array((int)($_SESSION['tipo'] ?? -1), [0, 1], true)) { http_response_code(403); exit('Sem permissão'); }
validarCSRF();
$id = filter_input(INPUT_POST,'id_marcacao',FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('ID inválido'); }
if ((int)$_SESSION['tipo'] === 1) {
    $owner = consultarBD('SELECT id FROM marcacao WHERE id=? AND id_utilizador=?', [$id, (int)$_SESSION['idutilizador']]);
    if (!$owner) { http_response_code(403); exit('Sem permissão'); }
}
consultarBD('DELETE FROM marcacao WHERE id=?',[$id]);
header('Location: ver_marcacao.php'); exit;
