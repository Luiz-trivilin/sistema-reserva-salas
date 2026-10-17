<?php
require_once "verificar_sessao.php";
include_once("comum.php");
include_once('metadados.php');
if ((int)($_SESSION['tipo'] ?? -1) !== 0) { http_response_code(403); exit('Sem permissão'); }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-AU-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css_login/estilo.css">
</head>
<body class="bg-light">

<div id="login" class="d-flex justify-content-center align-items-center vh-100">

    <form action="inserir.php" class="card shadow-lg p-4" method="POST" style="min-width: 400px;">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <div class="card-header text-center mb-3">
            <h2 class="text-primary"><i class="bi bi-person-plus-fill me-2"></i>Inserir Utilizador</h2>
        </div>

        <div class="card-body">
            <!-- Nome de Utilizador -->
            <div class="form-group mb-4">
                <label for="utilizador" class="form-label fw-bold" id="username-label">
                    <i class="bi bi-person-fill me-1"></i>Nome de Utilizador
                </label>
                <input type="text" class="form-control" id="utilizador" name="utilizador" placeholder="Digite o nome de utilizador" autocomplete="off" required oninput="validarUsername()">
            </div>

            <!-- Palavra Passe -->
            <div class="form-group mb-4">
                <label for="pass" class="form-label fw-bold" id="pass-label">
                    <i class="bi bi-lock-fill me-1"></i>Palavra Passe
                </label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Digite a palavra passe" required oninput="validarPassword()">
            </div>

            <!-- Confirme Palavra Passe -->
            <div class="form-group mb-4">
                <label for="confpass" class="form-label fw-bold" id="confpass-label">
                    <i class="bi bi-lock-check-fill me-1"></i>Confirme a Palavra Passe
                </label>
                <input type="password" class="form-control" id="confpass" name="confpass" placeholder="Confirme a palavra passe" required oninput=" validarConfpassword()">
            </div>

            <!-- Tipo de Utilizador -->
            <div class="form-group mb-4">
                <label for="tipo" class="form-label fw-bold">
                    <i class="bi bi-person-gear me-1"></i>Tipo de Utilizador
                </label>
                <select class="form-select" id="tipo" name="tipo">
                    <option value="0">Administrador</option>
                    <option value="1">Professor</option>
                    <option value="2" selected>Aluno</option>
                </select>
            </div>
        </div>

        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-check-circle me-1"></i>Registrar
            </button>

            <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
                <div class="alert alert-danger mt-3">
                    Conta não foi criada. Tente novamente ou entre em contato com o administrador.
                </div>
            <?php endif; ?>
        </div>
    </form>

</div>

</body>
</html>
