<?php
require_once("verificar_sessao.php");
require_once("comum.php");
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
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT numfuncionario, nomecompleto, tipo FROM utilizador ORDER BY nomecompleto ASC';
                $rs = consultarBD($sql);
                foreach ($rs as $registo) {
                    $idutilizador = $registo['numfuncionario'];
                    $utilizador = $registo['nomecompleto'];
                    $tipo = $registo['tipo'];

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
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $idutilizador ?>)">
                                    <i class="bi bi-trash3-fill"></i>Eliminar
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
        function confirmarExclusao(id) {
            Swal.fire({
                title: "Tem certeza que deseja eliminar o utilizador?",
                text: "Esta ação não pode ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, eliminar",
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
