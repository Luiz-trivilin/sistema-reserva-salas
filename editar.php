<?php
require_once 'verificar_sessao.php';
require_once 'comum.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if ((int)($_SESSION['tipo'] ?? -1) !== 2) { http_response_code(403); exit('Sem permissão'); }
$id = filter_input(INPUT_POST,'id_marcacao',FILTER_VALIDATE_INT);
$horario = filter_input(INPUT_POST,'id_horario',FILTER_VALIDATE_INT);
$sala = (string)($_POST['Nome_sala'] ?? '');
$prof = (string)($_POST['Nome_professor'] ?? '');
if (!$id || !$horario || $sala === '' || $prof === '') { http_response_code(400); exit('Dados inválidos'); }
consultarBD('UPDATE marcacao SET id_sala=(SELECT id_sala FROM salas WHERE nomesala=?), id_horario=?, id_utilizador=(SELECT numfuncionario FROM utilizador WHERE nomecompleto=?) WHERE id=?',[$sala,$horario,$prof,$id]);
header('Location: ver_marcacao.php'); exit;
