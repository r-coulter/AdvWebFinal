<?php require_once('security/DB.php'); ?>
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        $sql="SELECT * FROM contacts order by Name";
        $result=mysql_query($sql);
    }


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Ryan Coulter Portfolio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <img src="img/logo.png" alt="Ryan Coulter: Programmer">
                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="About.html">Who Am I?</a></li>
                        <li><a href="Projects.html">My work</a></li>
                        <li><a href="Services.html">Services</a></li>
                        <li><a href="Contact.html" >Contact</a></li>
                        <li><a href="login.php" class="active">My Contacts</a></li>

                    </ul>
                </nav>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                 
                <p>Welcome <?php echo($_SESSION['user']);?></p>
                <table class="contactTable">
                    <tr>
                        <td class="tblHead">Name</td><td class="tblHead">Phone</td><td class="tblHead">Address</td><td class="tblHead">Email</td>
                    </tr>
                <?php
                    //Process all returned rows
                    while ($row = mysql_fetch_assoc($result)) {
                        //Add a table row for each result row and adds an alert dialog (I don't know why we needed the alert. No one would EVER do this on a real website...)
                        echo("<tr><td><a href='' onClick='alert(\"".$row['Name'].", ".$row['Phone'].", ".$row['Address'].", ".$row['Email']."\")'>".$row['Name']."</td><td><a href='tel:".$row['Phone']."'>".$row['Phone']."</a></td><td>".$row['Address']."</td><td>".$row['Email']."</td></tr>");
                    }
                ?>
                </table>
                <!--Log out button-->
                <form method="post" action="security/logout.php">
                    <input type="submit" value="Log out">
                </form>
                 
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>Copyright Ryan Coulter 2013</h3>
            </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>

        <script src="js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

