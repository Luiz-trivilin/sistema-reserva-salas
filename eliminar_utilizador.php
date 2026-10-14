<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if ((int)($_SESSION['tipo'] ?? -1) !== 2) { http_response_code(403); exit('Sem permissão'); }
$id = filter_input(INPUT_POST,'idutilizador',FILTER_VALIDATE_INT);
if (!$id || $id === (int)$_SESSION['idutilizador']) { http_response_code(400); exit('ID inválido'); }
$conn = ligarBD(); if (!$conn) { http_response_code(500); exit; }
try {
    $conn->beginTransaction();
    $stmt=$conn->prepare('DELETE FROM marcacao WHERE id_utilizador=?'); $stmt->execute([$id]);
    $stmt=$conn->prepare('DELETE FROM utilizador WHERE numfuncionario=?'); $stmt->execute([$id]);
    $conn->commit();
} catch (Throwable $e) { $conn->rollBack(); http_response_code(500); exit('Operação não concluída'); }
header('Location: Eliminar_ver.php'); exit;
