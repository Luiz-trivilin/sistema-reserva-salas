<?php


    // Start a new session or resume the current one
    session_start();

    // Unset the session variable 'num_funcionario' to log out the user
    unset($_SESSION['pass']);

    // Destroy the entire session, effectively logging out the user
    session_destroy();

    // Redirect the user to the index page after logging out
    header("location:index.php");
