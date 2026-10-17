
<?php
include_once("verificar_sessao.php");
include_once("comum.php");
include_once("metadados.php");

$day = date('Y-m-d');

$id_marcacao_atual = (int)($_POST['id_marcacao_editar'] ?? 0);

$sql = "SELECT data_marcada FROM marcacao WHERE id = ?";
$resultado = consultarBD($sql, [$id_marcacao_atual]);

$data_final = $resultado[0]['data_marcada'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Marcação</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .editar-marcacao {
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-outline-primary {
            font-weight: bold;
        }

        .table th {
            padding: 15px;
            vertical-align: middle;
        }

        .table td {
            padding: 20px;
            vertical-align: middle;
        }

        .form-select {
            padding: 10px;
        }

        .botoes-editar {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }
    </style>
</head>

<body>

<div class="container my-4" id="professores">

    <h1 class="text-center mb-4">
        <i class="bi bi-calendar-check me-2"></i>
        Editar Marcação
    </h1>

    <div class="editar-marcacao border rounded p-4">

        <form id="editar_form"
              name="editar_form"
              action="editar.php"
              method="POST">

            <!-- Campos ocultos -->
            <input id="marcacao_id"
                   name="marcacao_id"
                   type="hidden"
                   value="<?php echo htmlspecialchars($data_final); ?>">

            <input id="horarioAtual"
                   name="horarioAtual"
                   type="hidden"
                   value="<?php echo htmlspecialchars($_POST['id_horario'] ?? ''); ?>">

            <input id="horario_inicio"
                   name="horario_inicio"
                   type="hidden"
                   value="<?php echo htmlspecialchars($_POST['horario_inicio'] ?? ''); ?>">

            <input id="horario_fim"
                   name="horario_fim"
                   type="hidden"
                   value="<?php echo htmlspecialchars($_POST['horario_fim'] ?? ''); ?>">

            <input id="Nome_sala"
                   name="Nome_sala"
                   type="hidden"
                   value="">

            <input id="id_horario"
                   name="id_horario"
                   type="hidden"
                   value="">

            <input id="Nome_professor"
                   name="Nome_professor"
                   type="hidden"
                   value="">

            <input id="id_marcacao"
                   name="id_marcacao"
                   type="hidden"
                   value="<?php echo $id_marcacao_atual; ?>">

            <!-- Tabela -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover text-center align-middle"
                       id="horarios-tabela">

                    <thead class="table-dark">
                        <tr>
                            <th scope="col">
                                <i class="bi bi-door-open me-2"></i>
                                Sala Marcada
                            </th>

                            <th scope="col">
                                <i class="bi bi-clock me-2"></i>
                                Horário
                            </th>

                            <?php if ($_SESSION['tipo'] == 0) { ?>
                                <th scope="col">
                                    <i class="bi bi-person me-2"></i>
                                    Professor
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <!-- Sala -->
                            <td>
                                <select id="sala"
                                        name="sala"
                                        class="form-select"
                                        onchange="carregarHorarios()">

                                    <option value="<?php echo htmlspecialchars($_POST['id_sala'] ?? ''); ?>">
                                        <?php echo htmlspecialchars($_POST['nomesala'] ?? ''); ?>
                                    </option>

                                    <?php
                                    $sql = 'SELECT id_sala, nomesala FROM salas';
                                    $rs = consultarBD($sql);

                                    foreach ($rs as $registo) {
                                        if ($registo['id_sala'] != ($_POST['id_sala'] ?? null)) {
                                            echo '<option value="' .
                                                htmlspecialchars($registo['id_sala']) .
                                                '">' .
                                                htmlspecialchars($registo['nomesala']) .
                                                '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>

                            <!-- Horário -->
                            <td>
                                <select id="horario"
                                        name="horario"
                                        class="form-select">
                                </select>
                            </td>

                            <!-- Professor -->
                            <?php if ($_SESSION['tipo'] == 0) { ?>
                                <td>
                                    <select id="professor"
                                            name="professor"
                                            class="form-select">

                                        <option value="<?php echo htmlspecialchars($_POST['id_professor'] ?? ''); ?>">
                                            <?php echo htmlspecialchars($_POST['nome_professor'] ?? ''); ?>
                                        </option>

                                        <?php
                                        $sql = 'SELECT * FROM utilizador';
                                        $rs = consultarBD($sql);

                                        foreach ($rs as $registo) {
                                            if ($registo['tipo'] == 1) {
                                                if ($registo['numfuncionario'] != ($_POST['id_professor'] ?? null)) {
                                                    echo '<option value="' .
                                                        htmlspecialchars($registo['numfuncionario']) .
                                                        '">' .
                                                        htmlspecialchars($registo['nomecompleto']) .
                                                        '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            <?php } ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </form>

        <div class="botoes-editar d-flex justify-content-center gap-3 mt-4">

    <button type="button"
            name="editar"
            class="btn btn-primary"
            onclick="mostrarTextoSelecionado()">

        <i class="bi bi-check-circle me-1"></i>
        Atualizar
    </button>

    <form class="voltar" action="ver_marcacao.php" method="POST">
        <button type="submit" name="botao" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i>
            Voltar
        </button>
    </form>

</div>
    </div>
</div>

<!-- Scripts -->
<script src="script/Botoes.js"></script>
<script src="script/ajax.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
