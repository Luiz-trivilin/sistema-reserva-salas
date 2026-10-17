<?php
require_once '../verificar_sessao.php';
require_once '../comum.php';
header('Content-Type: application/json; charset=utf-8');
$sala = filter_input(INPUT_POST,'id_sala',FILTER_VALIDATE_INT);
$data = (string)($_POST['data_marcada'] ?? date('Y-m-d'));
$d = DateTimeImmutable::createFromFormat('!Y-m-d',$data);
if (!$sala || !$d || $d->format('Y-m-d') !== $data) { http_response_code(400); echo '[]'; exit; }
echo json_encode(consultarBD('SELECT * FROM horario_escola WHERE id_horario NOT IN (SELECT id_horario FROM marcacao WHERE id_sala=? AND data_marcada=?)',[$sala,$data]));
