<?php
    include_once "../comum.php";
    $conn = ligarBD(); 
    date_default_timezone_set('Europe/Lisbon');
    $hora = date("H:i:s");

    if(isset($_POST['professor']) && !empty($_POST['professor'])){
        $id_professor = $_POST['professor'];

        $sql = ' SELECT
            marcacao.id,
            marcacao.id_utilizador,
            marcacao.Marcacao,
            utilizador.tipo,
            utilizador.nomecompleto,
            utilizador.numfuncionario,
            salas.nomesala,
            salas.id_sala,
            horario_escola.id_horario,
            horario_escola.horario_inicio,
            horario_escola.horario_fim
        FROM marcacao
        INNER JOIN salas ON marcacao.id_sala = salas.id_sala
        INNER JOIN horario_escola ON marcacao.id_horario = horario_escola.id_horario
        INNER JOIN utilizador ON marcacao.id_utilizador = utilizador.numfuncionario
        WHERE marcacao.id_utilizador ='.$id_professor.' ORDER BY marcacao.Marcacao;
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($horarios); // Retorna os dados em formato JSON
    } else {
        echo json_encode([]); // Retorna um array vazio se não houver dados
    }
?>