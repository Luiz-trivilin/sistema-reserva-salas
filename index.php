<!DOCTYPE html>
<?php include_once('metadados.php'); ?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css_login/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<div id="login" class="d-flex justify-content-center align-items-center vh-100">

    <form class="card shadow-lg p-5" action="login_vai.php" method="POST">

        <div class="card-header text-center">
            <h2 class="text-primary">Login</h2>
        </div>

        <div class="card-body">
            <!-- Input for Username -->
            <div class="form-group mb-4">
                <label for="utilizador">Utilizador</label>
                <input type="text" id="utilizador" name="utilizador" class="form-control" autocomplete="off" required>
            </div>

            <!-- Input for Password -->
            <div class="form-group mb-4">
                <label for="pass">Palavra Passe</label>
                <input type="password" id="pass" name="pass" class="form-control" autocomplete="off" required>
            </div>
        </div>

        <div class="card-footer text-center">
            <input type="submit" value="Login" class="btn btn-primary w-100">
            <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 1) {
                    echo '<div class="alert alert-danger mt-3">Problema nas credenciais</div>';
                } elseif ($_GET['erro'] == 2) {
                    echo '<div class="alert alert-warning mt-3">Site em Manutenção</div>';
                }
            }
            ?>
        </div>

    </form>

</div>

</body>
</html>
