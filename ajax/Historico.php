
<?php
require_once '../verificar_sessao.php';
require_once '../comum.php';

header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Europe/Lisbon');

$prof = filter_input(INPUT_POST, 'professor', FILTER_VALIDATE_INT);

if (!$prof) {
    echo '[]';
    exit;
}

$dia = date('Y-m-d');

$sql = <<<'SQL'
SELECT
    marcacao.id,
    marcacao.id_utilizador,
    marcacao.data_marcada,
    utilizador.tipo,
    utilizador.nomecompleto,
    utilizador.numfuncionario,
    salas.nomesala,
    salas.id_sala,
    horario_escola.id_horario,
    horario_escola.horario_inicio,
    horario_escola.horario_fim
FROM marcacao
INNER JOIN salas
    ON marcacao.id_sala = salas.id_sala
INNER JOIN horario_escola
    ON marcacao.id_horario = horario_escola.id_horario
INNER JOIN utilizador
    ON marcacao.id_utilizador = utilizador.numfuncionario
WHERE marcacao.id_utilizador = ?
AND marcacao.data_marcada < ?
ORDER BY marcacao.data_marcada DESC
SQL;

echo json_encode(consultarBD($sql, [$prof, $dia]));
