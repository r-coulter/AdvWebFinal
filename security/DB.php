<?php
    $host="localhost"; // Host name 
    $username="db200168042"; // Mysql username 
    $password="98292"; // Mysql password 
    $db_name="db200168042"; // Database name 
    $usr_name="admin"; // Table name 
    $tkt_name="Tickets"; // Table name

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");
?>
