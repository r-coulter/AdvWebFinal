<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is set skip the login page
    if($_SESSION['user']!=""){
        header("location:myContacts.php");
    }
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Styles/styleList.css" />
        <title>Tickets</title>
    </head>
    <body>
        <div class="navHeader">
            <div class="innerNavHeader">
                <a class="navHeaderLink left current">Login</a>
            </div>
        </div>
        <div class="loginForm">
            <form method="post" action="security/checkLogin.php">
                <table>
                    <p class="error"><?php echo($_SESSION['error']); ?></p><!--Output a login error if one exists-->
                    <tr><td>Username</td><td><input type="text" name="user"></td></tr>
                    <tr><td>Password</td><td><input type="password" name="password"></td></tr>
                </table>
                <input type="submit" class="loginLabel" value="Login">
            </form>
        </div>
    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

   