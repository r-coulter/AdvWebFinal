<?php
    //Kills the session and database connection then sends you back to login
    if (!isset($_SESSION)) {
        session_start();
    }
    session_destroy();
    mysql_close();
    header("location: ..\login.php");
?>

