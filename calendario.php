<?php
include_once("verificar_sessao.php");
include_once("comum.php");
include_once("metadados.php");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Registo de Salas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .calendario {
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .btn-outline-primary {
            font-weight: bold;
        }
        #mes {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .modal-content {
            padding: 2rem;
            text-align: center;
        }
        .modal-content h1 {
            font-size: 1.5rem;
            color: #dc3545;
        }
    </style>
</head>

<body>

<div class="container my-4">
    <h1 class="text-center mb-4"><i class="bi bi-calendar3-week me-2"></i>Registo de Salas</h1>

    <div class="calendario border rounded p-4">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-outline-primary" id="btn_ant"><i class="bi bi-arrow-left-circle"></i></button>
            <h2 id="mes" class="mb-0">Janeiro 2025</h2>
            <button class="btn btn-outline-primary" id="btn_prev"><i class="bi bi-arrow-right-circle"></i></button>
        </header>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>
                </tr>
            </thead>
            <tbody id="dias">
                <!-- Calendário será preenchido dinamicamente -->
                <?php for ($i=0; $i<6; $i++) { echo "<tr>".str_repeat("<td></td>",7)."</tr>"; } ?>
            </tbody>
        </table>

        <footer class="text-center mt-4">
            <h2 id="ano"></h2>
        </footer>

        <!-- Botões de ação -->
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <form class="fim_sessao" action="fim_sessao.php" method="POST">
                <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-right me-1"></i>Terminar Sessão</button>
            </form>

            <form class="mostrar" action="ver_marcacao.php" method="POST">
                <input type="hidden" id="dia_click" name="dia_click">
                <input type="hidden" id="mes_click" name="mes_click">
                <input type="hidden" id="ano_click" name="ano_click">
                <button type="submit" class="btn btn-info"><i class="bi bi-eye-fill me-1"></i>Conferir Marcação</button>
            </form>

            <?php if ($_SESSION['tipo'] == 0) { ?>
                <form class="criar" action="novo_usuario.php" method="POST">
                    <button type="submit" class="btn btn-success"><i class="bi bi-person-plus-fill me-1"></i>Criar nova conta</button>
                </form>
                <form class="Eliminar" action="Eliminar_ver.php" method="POST">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-people-fill me-1"></i>Gerenciar Contas</button>
                </form>
            <?php } ?>

            <?php if ($_SESSION['tipo'] < 2) { ?>
                <form id="marcar_form" action="marcar.php" method="POST">
                    <input type="hidden" id="dia_post" name="dia_post">
                    <input type="hidden" id="mes_post" name="mes_post">
                    <input type="hidden" id="ano_post" name="ano_post">
                </form>
                <form class="Historico" action="Historico.php" method="POST">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-clock-history me-1"></i>Ver Histórico</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Modal de Erro -->
<div id="ModalError" class="modal">
    <div class="modal-content">
        <span class="closeError">&times;</span>
        <h1><i class="bi bi-x-circle-fill text-danger me-2"></i>Impossível Marcar Sala</h1>
    </div>
</div>

<!-- Modal Sem Seleção -->
<div id="ModalNotSelect" class="modal">
    <div class="modal-content">
        <span class="closeError">&times;</span>
        <h1><i class="bi bi-exclamation-circle-fill text-warning me-2"></i>Selecione um dia para marcar a sala</h1>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="script/Script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
