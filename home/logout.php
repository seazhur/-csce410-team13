<!-- This was written by Adidev Mohapatra 
This form is to logout the user and return them back to the login page. -->
<?php
    // start session
    session_start();

    // destroy session
    session_destroy();

    // redirect to login page or homepage
    header('Location: login.php');
?>