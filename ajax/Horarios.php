<?php
require_once '../verificar_sessao.php';
require_once '../comum.php';
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Europe/Lisbon');
$sala = filter_input(INPUT_POST, 'id_sala', FILTER_VALIDATE_INT);
$atual = filter_input(INPUT_POST, 'id_horario_atual', FILTER_VALIDATE_INT);
$data = (string)($_POST['data_marcada'] ?? '');
if (!$sala || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data) || !checkdate((int)substr($data,5,2),(int)substr($data,8,2),(int)substr($data,0,4))) {
    http_response_code(400); echo '[]'; exit;
}
$sql = 'SELECT * FROM horario_escola WHERE id_horario NOT IN (SELECT id_horario FROM marcacao WHERE id_sala=? AND data_marcada=?)';
$params = [$sala, $data];
if ($data === date('Y-m-d')) { $sql .= ' AND horario_fim > ?'; $params[] = date('H:i:s'); }
if ($atual) { $sql .= ' AND id_horario != ?'; $params[] = $atual; }
echo json_encode(consultarBD($sql, $params));
