﻿<?php require_once('security/DB.php'); ?>
<?php
    
    /*    
Author: Ryan Coulter
Web site name: AdvWebFinal
Description: Main page, search for, edit and create tickets
*/

    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        if($_REQUEST['View']=="all"){//Display All tickets or only Open/Pending tickets
            $sql="SELECT T.ID,T.Description,T.Priority,T.Narrative,Customer_Name,T.Title,T.Status,T.Owner,A.user FROM Tickets as T LEFT JOIN admin as A on T.Owner=A.ID order by Priority Desc, Status";
        }else{
            $sql="SELECT T.ID,T.Description,T.Priority,T.Narrative,Customer_Name,T.Title,T.Status,T.Owner,A.user FROM Tickets as T LEFT JOIN admin as A on T.Owner=A.ID WHERE T.Status<2 order by Priority Desc, Status";
        }
        
        $result=mysql_query($sql);
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
                <a class="navHeaderLink left current">All Tickets</a><a href="view.php" class="navHeaderLink left">My Tickets</a><a href="security/logout.php" class="contactButton right">Log Out</a><a href="create.php" class="contactButton right" onclick="">New Ticket</a><a href="search.php?View=all" class="contactButton right" onclick="">View All</a>
            </div>
        </div>

        <div class="searchHeader">
            <input type="text" id="searchInput" class="left" placeholder="Search"><img id="searchBtn" class="left" src="Images/search.png" onclick="search()">

           
        </div>

        <div class="tableDiv">
            <table id="listTable2">
                <tr class="headerRow">
                        <td class="clmPriority">Priority</td>
                        <td class="clmTitle">Title</td>
                        <td class="clmCustomer">Customer</td>
                        <td class="clmStatus">Status</td>
                        <td class="clmClaim">Owner</td>
                    </tr>
                <!--Repeat with PHP-->
                <?php
                    //Process all returned rows
                    $status = "";
                    while ($row = mysql_fetch_assoc($result)) {
                        if($row['Status']==0){
                            $status="Open";
                        }elseif($row['Status']==1){
                            $status="Pending";
                        }elseif($row['Status']==2){
                            $status="Finished";
                        }elseif($row['Status']==3){
                            $status="Closed";
                        }
                        echo('
                        <tr class="row" onclick="window.location.href=&quot;view.php?Ticket='.$row['ID'].'&quot;">
                            <td class="clmPriority clm">'.$row['Priority'].'</td>
                            <td class="clmTitle clm">'.$row['Title'].'</td>
                            <td class="clmCustomer clm">'.$row['Customer_Name'].'</td>
                            <td class="clmStatus clm">'.$status.'</td>
                            <td class="clmClaim clm">'.$row['user'].'</td>
                        </tr>
                        ');
                    }
                ?>
                <!--/PHP-->
            </table>
        </div>
    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>//Event Listeners
    $(document).ready(function () {          
        //The enter key can be used to search as well as clicking the button
        $("#searchInput").keyup(function(event){
            if(event.keyCode == 13){
                search();
            }
        });
    });

    //Checks if the search text exists within and of the columns
    function search(){
        var query=$("#searchInput").val();
        if(query==""){
            $(".row").attr("class","row");
            return;
        }
        $(".row").attr("class","row hidden");
        $(".clmTitle").each(function(){
                if($(this).text().toLowerCase().indexOf(query.toLowerCase())>-1)$(this).parent().removeClass("hidden").addClass("result");
        });
        $(".clmPriority").each(function(){
                if($(this).text().toLowerCase().indexOf(query.toLowerCase())>-1)$(this).parent().removeClass("hidden").addClass("result");
        });
        $(".clmCustomer").each(function(){
                if($(this).text().toLowerCase().indexOf(query.toLowerCase())>-1)$(this).parent().removeClass("hidden").addClass("result");
        });
        $(".clmStatus").each(function(){
                if($(this).text().toLowerCase().indexOf(query.toLowerCase())>-1)$(this).parent().removeClass("hidden").addClass("result");
        });
        $(".clmClaim").each(function(){
                if($(this).text().toLowerCase().indexOf(query.toLowerCase())>-1)$(this).parent().removeClass("hidden").addClass("result");
        });
    }
</script>