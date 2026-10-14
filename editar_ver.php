<?php
include("verificar_sessao.php");
include("comum.php");
include("metadados.php");

$day = date('Y-m-d');
$id_marcacao_atual = $_POST['id_marcacao_editar'];

$sql = "SELECT Marcacao FROM marcacao WHERE id=?";
$resultado = consultarBD($sql, [(int)$id_marcacao_atual]);
$data_final = $resultado[0]['Marcacao'] ?? '';



?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
</head>

<body>

    <div class="container" id="professores">
        <table class="table table-sm table-striped table-hover table-bordered mt-2" id="horarios-tabela">
            <thead>
                <tr>
                    <th scope="col">Sala Marcada</th>
                    <th scope="col">Horário</th>
                    <?php
                    if ($_SESSION['tipo'] == 0) {
                    ?>
                        <th scope="col">Professor</th>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <form id="editar_form" name="editar_form" action="editar.php" method="POST">
                        <td>
                            <input id="marcacao_id" name="marcacao_id" type="hidden" value="<?php echo $data_final ?>">

                            <select id="sala" name="sala" onchange="carregarHorarios()">
                                <option value="<?php echo $_POST['id_sala'] ?>"> <?php echo $_POST['nomesala'] ?></option>
                                <?php
                                $sql = 'select id_sala,nomesala from salas;';
                                $rs = consultarBD($sql);
                                foreach ($rs as $registo) {
                                    if ($registo['id_sala'] != $_POST['id_sala']) {
                                        echo '<option value="' . $registo['id_sala'] . '">' . $registo['nomesala'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                                <input id="horarioAtual" name="horarioAtual" type="hidden" value="<?php $_POST['id_horario']?>">
                                <input id="horario_inicio" name="horario_inicio" type="hidden" value="<?php echo $_POST['horario_inicio']?>" >
                                <input id="horario_fim" name="horario_fim" type="hidden" value="<?php echo $_POST['horario_fim']?>">
                            <select id="horario" name="horario">
                            
                        </select>
                            
                        </td>
                        <?php
                        if ($_SESSION['tipo'] == 0) {
                        ?>
                            <td>
                                <select id="professor" name="professor">
                                    <option value=""> <?php echo $_POST['nome_professor'] ?> </option>
                                    <?php
                                    $sql = 'select * from utilizador';
                                    $rs = consultarBD($sql);
                                    foreach ($rs as $registo) {
                                        if ($registo['tipo'] == 1) {
                                            if ($registo['numfuncionario'] != $_POST['id_professor']) {
                                                echo '<option value="' . $registo['numfuncionario'] . '">' . $registo['nomecompleto'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        <?php

                        }
                        ?>
                </tr>
                <input id="Nome_sala" name="Nome_sala" type="hidden" value="">
                <input id="id_horario" name="id_horario" type="hidden" value="">
                <input id="Nome_professor" name="Nome_professor" type="hidden" value="">
                <input id="id_marcacao" name="id_marcacao" type="hidden" value="<?php echo $_POST['id_marcacao_editar']; ?>">
                </form>

            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <form class="editar" action="editar.php" method="POST">
    </form>
    <form class="voltar" action="ver_marcacao.php" method="POST">
        <input name="botao" type="submit" value="Voltar">
    </form>

    <script src="script/Botoes.js"></script>
    <script src="script/ajax.js"></script>