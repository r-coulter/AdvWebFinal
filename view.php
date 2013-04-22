﻿<?php require_once('security/DB.php'); ?>
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        $sql="SELECT * FROM Tickets WHERE Owner=".$_SESSION['ID']." ORDER by Priority Desc";
        $result=mysql_query($sql);
    }


?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Styles/styleList.css" />
        <title> <?php echo($_SESSION['user']."'s");?> Tickets</title>
    </head>
    <body>
        <div class="navHeader">
            <div class="innerNavHeader">
                <a href="search.php" class="navHeaderLink left">All Tickets</a><a class="navHeaderLink left current">My Tickets</a><a href="security/logout.php" class="contactButton right">Log Out</a>
            </div>
        </div>
        <?php echo($_SESSION['ID']);?>
        <!--469px-->
        <div class="profileBody">

            <!--PHP Load-->
            
                <?php
                    while ($row = mysql_fetch_assoc($result)) {
                        echo('
                            <div class="listings">
                                <div class="listing" id="listing'.$row['ID'].'">
                                    <div class="listingHead" onclick="toggleView('.$row['ID'].')">
                                        <span id="listingTitle-'.$row['ID'].'" class="listingHeadTitle left">'.$row['Priority'].'</span>
                                        <select class="listingHeadSelect editSelect right" id="published-'.$row['ID'].'">
                                            <option value="0">Open</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Finished</option>
                                            <option value="-1">Closed</option>
                                        </select>
                                    </div>
                                    <div id="body'.$row['ID'].'" class="listingBody closed">
                                        <div class="listingBodyLeft left">
                                            <table class="profileTable">
                                                <tr><td class="profileTableLabel">Title</td><td><input class="inputWidth editText title" id="Title-'.$row['ID'].'" type="text" value="'.$row['Title'].'"></td></tr>
                                                <tr><td class="profileTableLabel">Customer</td><td><input class="inputWidth  editText" id="Customer-'.$row['ID'].'" type="text" value="'.$row['Customer_Name'].'"></td></tr>
                                               <tr><td class="profileTableLabel">Owner</td><td>
                                               <div><select id="priority" class="inputWidth editSelect">
                                                        <option>Me</option>
                                                        <option>You</option>
                                                        <option>Him</option>
                                                    </select></div>
                                                </td></tr>
                                                <tr><td class="profileTableLabel">Priority</td><td>
                                                <div><select id="priority" class="inputWidth editSelect">
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select></div>
                                                </td></tr>
                                                <tr><td class="profileTableLabel" style="position: relative;top: -100px;">Description</td><td><textarea maxlength="325" class="inputWidth  editText" id="Description-'.$row['ID'].'">'.$row['Description'].'</textarea></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ');
                    }
                ?>
        </div>

    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>
    var mode=0;
    $(document).ready(function () {   
        $(".title").change(function(evt){
            return;
            var eleID = evt.currentTarget.id.split("-")[1];
            $("#listingTitle-"+eleID).text($(".title").val()+" - "+$(".title").val());
        });
        $(".title").trigger("change");
    });

    function toggleView(listingNum){
        if($('select').is(":focus"))return;
        if($("#body"+listingNum).hasClass("open")){
            $(".open").removeClass("open").addClass("closed");
            return;
        }
        $(".open").removeClass("open").addClass("closed");
        $("#body"+listingNum).addClass("open").removeClass("closed");
    }

    Number.prototype.formatMoney = function (c, d, t) {
        var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };



</script>

<script>
</script>