<?php
require_once("verificar_sessao.php");
require_once("comum.php");
if ((int)($_SESSION['tipo'] ?? -1) !== 0) { http_response_code(403); exit('Sem permissão'); }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Utilizadores</title>
    <?php require_once('metadados.php') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Utilizadores</h2>
        <table class="table table-bordered table-hover table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Utilizador</th>
                    <th>Tipo</th>
                    <th>Estado / Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT numfuncionario, nomecompleto, tipo, valido FROM utilizador ORDER BY nomecompleto ASC';
                $rs = consultarBD($sql);
                foreach ($rs as $registo) {
                    $idutilizador = $registo['numfuncionario'];
                    $utilizador = $registo['nomecompleto'];
                    $tipo = $registo['tipo'];
                    $ativo = (int)$registo['valido'] === 1;

                    $tipoTexto = match ($tipo) {
                        0 => '<i class="bi bi-shield-lock-fill text-danger me-1"></i>Administrador',
                        1 => '<i class="bi bi-easel-fill text-primary me-1"></i>Professor',
                        default => '<i class="bi bi-pencil-fill text-success me-1"></i>Aluno'
                    };
                ?>
                    <tr>
                        <td><?= htmlspecialchars($utilizador) ?></td>
                        <td><?= $tipoTexto ?></td>
                        <td>
                            <?php if ($_SESSION['idutilizador'] != $idutilizador) : ?>
                                <form id="form-<?= $idutilizador ?>" action="eliminar_utilizador.php" method="POST" class="d-inline">
                                    <input type="hidden" name="idutilizador" value="<?= $idutilizador ?>">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <input type="hidden" name="acao" value="<?= $ativo ? 'desativar' : 'reativar' ?>">
                                    <button type="button" class="btn <?= $ativo ? 'btn-danger' : 'btn-success' ?> btn-sm" onclick="confirmarExclusao(<?= $idutilizador ?>, <?= $ativo ? 'true' : 'false' ?>)">
                                    <i class="bi <?= $ativo ? 'bi-person-dash' : 'bi-person-check' ?>"></i><?= $ativo ? 'Desativar' : 'Reativar' ?>
                                    </button>
                                </form>
                            <?php else : ?>
                                <span class="text-muted">Atual</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <form class="voltar" action="calendario.php" method="POST">
            <button type="submit" class="btn btn-outline-primary btn-lg rounded-pill shadow-sm px-5">
                <i class="bi bi-arrow-left-circle me-2"></i> Voltar
            </button>
        </form>
    </div>

    <script>
        function confirmarExclusao(id, ativo) {
            Swal.fire({
                title: ativo ? "Desativar utilizador?" : "Reativar utilizador?",
                text: ativo ? "A conta será desativada, mantendo o histórico." : "A conta poderá voltar a iniciar sessão.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: ativo ? "Sim, desativar" : "Sim, reativar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${id}`).submit();
                }
            });
        }
    </script>
</body>

</html>
