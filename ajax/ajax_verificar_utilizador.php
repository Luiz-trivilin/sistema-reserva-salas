<?php
require_once '../verificar_sessao.php';
require_once '../comum.php';
$user = strtolower(trim((string)($_POST['utilizador'] ?? '')));
if ($user === '') { echo '0'; exit; }
echo count(consultarBD('SELECT numfuncionario FROM utilizador WHERE nomecompleto=?',[$user]));
