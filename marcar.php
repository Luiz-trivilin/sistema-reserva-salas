<?php
include_once('verificar_sessao.php');
include_once('metadados.php');
include_once('comum.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcação</title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="Css/Estilo_marcar.css" rel="stylesheet">
    <style>
        
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card card-custom">
            <form action="marcar_sala.php" method="post" id="formulario">
                <input type="hidden" id="id_sala" name="id_sala" value="">
                <input type="hidden" id="id_horario" name="id_horario" value="">
                <input type="hidden" id="dia_click" name="dia_click" value="<?php echo $_POST['dia_post'] ?>">
                <input type="hidden" id="mes_click" name="mes_click" value="<?php echo $_POST['mes_post'] + 1 ?>">
                <input type="hidden" id="ano_click" name="ano_click" value="<?php echo $_POST['ano_post'] ?>">

                <label for="sala" class="form-label fw-bold">
                    <i class="bi bi-door-closed me-1"></i>Selecione a Sala:
                </label>
                <select id="sala" name="sala" class="form-select mb-4">
                    <option value="">-- Selecione uma Sala --</option>
                    <?php
                    $sql = 'select * from salas';
                    $rs = consultarBD($sql);
                    foreach ($rs as $registo) {
                        echo '<option value="' . $registo['id_sala'] . '">' . $registo['nomesala'] . '</option>';
                    }
                    ?>
                </select>

                <div id="salas-marcadas" style="display: none;">
                    <h3 class="text-center mb-3">
                        <i class="bi bi-clock me-1"></i>Horários das Salas
                    </h3>
                    <table id="horarios-tabela" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><i class="bi bi-play-circle me-1"></i>Início</th>
                                <th><i class="bi bi-stop-circle me-1"></i>Fim</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="script/Script.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
