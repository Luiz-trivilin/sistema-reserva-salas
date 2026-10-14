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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="Css/Historico.css" rel="stylesheet">
    
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="select-container">
            <label for="professor" class="form-label fw-bold">
                <i class="bi bi-person-lines-fill me-2"></i>Selecione o Professor:
            </label>
            <select id="professor" name="professor" class="form-select">
                <option value="" id="default-option" style="display: none;">-- Selecione o Professor --</option>
                <?php
                $sql = 'SELECT nomecompleto, numfuncionario, tipo FROM utilizador';
                $rs = consultarBD($sql);
                foreach ($rs as $registo) {
                    if ($registo['tipo'] === 1) {
                        echo '<option value="' . $registo['numfuncionario'] . '">' . $registo['nomecompleto'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="container mt-4" id="professores" style="display: none;">
            <h4 class="text-center my-4">
                <i class="bi bi-calendar-event me-2"></i>Historico do Professor
            </h4>
            <div class="table-responsive shadow rounded">
                <table class="table table-striped table-hover table-bordered" id="horarios-tabela">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="Sala_Marcada">
                                <i class="bi bi-door-open me-1"></i>Sala Marcada
                            </th>
                            <th scope="col" class="Dia_Marcado">
                                <i class="bi bi-calendar-day me-1"></i>Dia Marcado
                            </th>
                            <th scope="col" class="Horario">
                                <i class="bi bi-clock me-1"></i>Horário
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Preenchido dinamicamente -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-5">
            <form class="voltar" action="calendario.php" method="POST">
                <button type="submit" class="btn btn-outline-primary btn-lg rounded-pill shadow px-4">
                    <i class="bi bi-arrow-left-circle me-2"></i>Voltar ao Calendário
                </button>
            </form>
        </div>
    </div>

    <div id="user-info" data-usuariologado="<?php echo $_SESSION['idutilizador']; ?>"></div>
    <div id="user-tipo" data-tipo="<?php echo $_SESSION['tipo']; ?>"></div>

    <script type="text/javascript" src="script/Historico.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
