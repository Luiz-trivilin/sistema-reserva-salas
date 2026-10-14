<?php
include("verificar_sessao.php");
include("comum.php");
include("metadados.php");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
    <?php require_once('metadados.php') ?>

    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Seu CSS personalizado -->
    <link rel="stylesheet" href="css/Estilo_marcacao.css">
</head>

<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4"><i class="bi bi-calendar-check me-2"></i>Consulta de Marcação de Salas</h2>

        <div class="mb-4">
            <label for="Professores" class="form-label fw-bold"><i class="bi bi-person-badge me-1"></i>Selecione o Professor:</label>
            <select id="professor" name="professor" class="form-select">
                <option value="" id="default-option" style="display: none;">-- Selecione o Professor --</option>
                <?php
                $sql = 'select nomecompleto,numfuncionario,tipo from utilizador';
                $rs = consultarBD($sql);
                foreach ($rs as $registo) {
                    if($registo['tipo'] === 1){
                        echo '<option value="' . $registo['numfuncionario'] . '">' . $registo['nomecompleto'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="container" id="professores" style="display: none;">
            <table class="table table-sm table-striped table-hover table-bordered mt-4" id="horarios-tabela">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col"><i class="bi bi-door-closed me-1"></i>Sala Marcada</th>
                        <th scope="col"><i class="bi bi-calendar-event me-1"></i>Dia Marcado</th>
                        <th scope="col"><i class="bi bi-clock me-1"></i>Horário</th>
                        <th scope="col"><i class="bi bi-trash-fill"></i> Eliminar</th>
                        <th scope="col"><i class="bi bi-pencil-fill"></i> Editar</th>
                    </tr>
                    <form id="eliminar" action="eliminar.php" method="POST">
                        <input id="id_marcacao" name="id_marcacao" type="hidden" value="">
                    </form>
                    <form id="alterar" action="editar_ver.php" method="POST">
                        <input id="id_marcacao_editar" name="id_marcacao_editar" type="hidden" value="">
                        <input id="nomesala" name="nomesala" type="hidden" value="">
                        <input id="horario_inicio" name="horario_inicio" type="hidden" value="">
                        <input id="horario_fim" name="horario_fim" type="hidden" value="">
                        <input id="nome_professor" name="nome_professor" type="hidden" value="">
                        <input id="id_sala" name="id_sala" type="hidden" value="">
                        <input id="id_horario" name="id_horario" type="hidden" value="">
                        <input id="id_professor" name="id_professor" type="hidden" value="">
                    </form>
                </thead>
                <tbody>
                    <!-- Linhas dinâmicas via script -->
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <form class="voltar" action="calendario.php" method="POST">
                <button type="submit" class="btn btn-outline-primary btn-lg rounded-pill shadow-sm px-4">
                    <i class="bi bi-arrow-left-circle me-2"></i>Voltar ao Calendário
                </button>
            </form>
        </div>
    </div>

    <div id="user-info" data-usuariologado="<?php echo $_SESSION['idutilizador']; ?>"></div>
    <div id="user-tipo" data-tipo="<?php echo $_SESSION['tipo']; ?>"></div>

    <!-- Link para o script -->
    <script type="text/javascript" src="script/script_ver_marcacao.js" defer></script>

    <!-- Incluindo o Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
