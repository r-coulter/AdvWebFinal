<?php require_once('security/DB.php'); ?>
<?php
    
    /*    
Author: Ryan Coulter
Web site name: AdvWebFinal
Description: Adds a new ticket to the database
*/


    if (!isset($_SESSION)) {//Creates a new user and then logs them in.
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        //$sql="SELECT * FROM Tickets as T LEFT JOIN admin as A on T.Owner=A.ID order by Priority Desc";
        //$result=mysql_query($sql);
        date_default_timezone_set('EST');
        $Title=stripslashes($_REQUEST['Title']);
        $Title=mysql_real_escape_string($Title);
        $Customer=stripslashes($_REQUEST['Customer']);
        $Customer=mysql_real_escape_string($Customer);
        $Owner=stripslashes($_REQUEST['Owner']);
        if($Owner=="0"){
            $Status="0";
        } else {
            $Status="1";
        }
        $Priority=$_REQUEST['Priority'];
        $Description=stripslashes($_REQUEST['Description']);
        $Description=mysql_real_escape_string($Description);
        $Narrative=date('j-m-y h:i A').": Ticket created";

        $sql="INSERT INTO Tickets (ID,Description,Priority,Narrative,Customer_Name,Title,Status,Owner) VALUES(0,'".$Description."',".$Priority.",'".$Narrative."','".$Customer."','".$Title."',".$Status.",".$Owner.")";
        $result=mysql_query($sql);

        if (!$result) {
            echo($sql."<br>");
            die('Invalid query: ' . mysql_error());
        }else{
            header("location:search.php");
        }
    }


?>