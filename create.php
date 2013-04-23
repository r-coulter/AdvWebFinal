<?php require_once('security/DB.php'); ?>
<?php
    
    /*    
Author: Ryan Coulter
Web site name: AdvWebFinal
Description: Ticket creation form
*/


    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        $sql="SELECT ID,user FROM admin";
        $result=mysql_query($sql);
    }


?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Styles/styleList.css" />
        <title>Create a Ticket</title>
    </head>
    <body>
        <div class="navHeader">
            <div class="innerNavHeader">
                <a href="search.php"class="navHeaderLink left">All Tickets</a><a class="navHeaderLink left current">New Ticket</a><a href="security/logout.php" class="contactButton right" onclick="">Log Out</a>
            </div>
        </div>

        <div class="profileBody">
            <div class="profileFormDiv left">
                <form method="post" action="createTicket.php">
                    <table class="profileTable">
                        <tr><td class="profileTableLabel">Title</td><td><input class="inputWidth editText" name="Title" type="text" value=""></td></tr>
                        <tr><td class="profileTableLabel">Customer</td><td><input class="inputWidth  editText" name="Customer" type="text" value=""></td></tr>
                        <tr><td class="profileTableLabel">Owner</td><td>
                            <div><select name="Owner" class="inputWidth editSelect">
                                <option value="0" selected>Not Assigned</option>
                                <?php //Populate the owner box with a list of users
                                    while ($row = mysql_fetch_assoc($result)) {
                                        echo("<option value='".$row['ID']."'>".$row['user']."</option>");
                                    }
                                ?>
                            </select></div>
                        </td></tr>
                        <tr><td class="profileTableLabel">Priority</td><td>
                        <div><select name="Priority" class="inputWidth editSelect">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select></div>
                        </td></tr>
                        <tr>
                            <td class="profileTableLabel" style="position: relative;top: -100px;">Description</td>
                            <td><textarea name="Description" class="editText" maxlength="325"></textarea></td>
                        </tr>
                        <tr><td></td><td><input type="submit" value="Create Ticket"></td></tr>
                    </table>
                    
                </form>
            </div>
        </div>

    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
