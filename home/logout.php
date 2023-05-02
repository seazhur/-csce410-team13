<?php
    // start session
    session_start();

    // destroy session
    session_destroy();

    // redirect to login page or homepage
    header('Location: login.php');
?>