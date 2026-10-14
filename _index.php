<!DOCTYPE html>

<?php include_once('metadados.php'); ?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding to UTF-8, allowing special characters support -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Ensures compatibility with the latest IE mode -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configures viewport for mobile responsiveness -->

    <link rel="stylesheet" type="text/css" href="css_login/estilo.css"> <!-- Links external CSS file for page styling -->

    <title> Login </title> <!-- Defines the page title that appears in the browser tab -->
</head>

<body>

    <!-- Main container to center the login form -->
    <div id="login">

        <!-- Login form, sending data via POST method to login_vai.php -->
        <form class="card" action="login_vai.php" method="POST">

            <!-- Form header with login title -->
            <div class="card-header">
                <h2>Login</h2>
            </div>

            <!-- Content area of the form -->
            <div class="card-content">

                <!-- Input field for username -->
                <div class="card-content-area">
                    <label for="utilizador">Utilizador</label> <!-- Label for the username field -->
                    <input type="text" id="utilizador" name="utilizador" autocomplete="off" required> <!-- Text input for username -->
                </div>

                <!-- Input field for password -->
                <div class="card-content-area">
                    <label for="pass">Palavra Passe</label> <!-- Label for the password field -->
                    <input type="password" id="pass" name="pass" autocomplete="off" required> <!-- Password input field -->
                </div>

                <!-- Form footer with links and submit button -->
                <div class="card-footer">

                    <input type="submit" value="Login" class="submit"> <!-- Button to submit the form -->

                    <!-- PHP to display error messages if credentials are invalid -->
                    <?php
                    if (isset($_GET['erro'])) {

                        if ($_GET['erro'] == 1) {
                            $str = '<div class="alert alert-danger py-1 my-0" role="alert">';
                            $str .= '<h3>Problema na Palavra Passe</h3> </div>';
                            echo $str;
                            unset($_SESSION['erro']);
                        } else if ($_GET['erro'] == 2) {
                            $str = '<div class="alert alert-danger py-1 my-0" role="alert">';
                            $str .= '<h3>Erro Na consulta</h3> </div>';
                            echo $str;
                            unset($_SESSION['erro']);
                        } else if (isset($_SESSION['erro'])) {
                            $str = '<div class="alert alert-danger py-1 my-0" role="alert">';
                            $str .= $_SESSION['erro'] . '</div>';
                            echo $str;
                            unset($_SESSION['erro']);
                        }
                    }
                    ?>
                </div>

            </div>

        </form>

    </div>

</body>

</html>