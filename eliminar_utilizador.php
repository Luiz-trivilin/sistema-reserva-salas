<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if ((int)($_SESSION['tipo'] ?? -1) !== 0) { http_response_code(403); exit('Sem permissão'); }
validarCSRF();
$id = filter_input(INPUT_POST, 'idutilizador', FILTER_VALIDATE_INT);
$acao = (string)($_POST['acao'] ?? 'desativar');
if (!$id || !in_array($acao, ['desativar', 'reativar'], true) || $id === (int)$_SESSION['idutilizador']) {
    http_response_code(400); exit('Dados inválidos');
}
try {
    consultarBD('UPDATE utilizador SET valido = ? WHERE numfuncionario = ?', [($acao === 'reativar' ? 1 : 0), $id]);
} catch (Throwable $e) {
    error_log('Erro ao alterar estado da conta: ' . $e->getMessage());
    http_response_code(500); exit('Operação não concluída');
}
header('Location: Eliminar_ver.php'); exit;
