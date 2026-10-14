<?php
include("../comum.php");
date_default_timezone_set('Europe/Lisbon');
    
if (isset($_POST['id_sala'])) {
    $id_sala = $_POST['id_sala'];
    $data_marcacao = $_POST['data_marcada'];
    $id_horario_atual = $_POST['id_horario_atual'];


    $hoje = date("Y-m-d");
    $hora = date("H:i:s");
    if($data_marcacao == $hoje){
        $sql = "SELECT * FROM horario_escola 
                WHERE id_horario NOT IN (
                    SELECT id_horario FROM marcacao WHERE id_sala = $id_sala
                ) AND horario_fim > '$hora'";
    }else{
        $sql = "SELECT * FROM horario_escola 
        WHERE id_horario NOT IN (
            SELECT id_horario FROM marcacao WHERE id_sala = $id_sala
        )";
    }

    if ($id_horario_atual) {
        $sql .= " AND id_horario != ".$id_horario_atual."";
    }

    $sql .= ";";

    //echo $sql;
    //return;

    $horarios = consultarBD($sql);

    // Retornar os horários como JSON
    echo json_encode($horarios);
}
?>