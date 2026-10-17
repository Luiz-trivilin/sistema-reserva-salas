<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
$sala = filter_input(INPUT_POST,'id_sala',FILTER_VALIDATE_INT);
$horario = filter_input(INPUT_POST,'id_horario',FILTER_VALIDATE_INT);
$d = filter_input(INPUT_POST,'dia_click',FILTER_VALIDATE_INT);
$m = filter_input(INPUT_POST,'mes_click',FILTER_VALIDATE_INT);
$a = filter_input(INPUT_POST,'ano_click',FILTER_VALIDATE_INT);

if (!$sala || !$horario || !$d || !$m || !$a || !checkdate($m,$d,$a)) { http_response_code(400); exit('Dados inválidos'); }
$data = sprintf('%04d-%02d-%02d',$a,$m,$d);
try {
    consultarBD('INSERT INTO marcacao (id_sala,id_horario,id_utilizador,data_marcada) VALUES (?,?,?,?)', [$sala,$horario,$_SESSION['idutilizador'],$data]);
} catch (PDOException $e) { echo $e; exit('Não foi possível reservar: horário indisponível ou inválido');}
header('Location: calendario.php'); exit;
