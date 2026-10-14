<?php
    session_start();
    if (!isset($_SESSION['idutilizador'])) {
        $_SESSION['erro'] = 'Inicie a sessão';
        header('Location:_index.php');
        die();
    }
?>

