<?php require_once('security/DB.php'); ?>
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    //If the session user variable is blank redirect to the login screen. Otherwise grab sorted contacts from the database.
    if($_SESSION['user']==""){
        header("location:login.php");
    }else{
        if($_REQUEST['Ticket']!=""){
            $sql="SELECT T.ID,T.Description,T.Priority,T.Narrative,Customer_Name,T.Title,T.Status,T.Owner,A.user FROM Tickets as T LEFT JOIN admin as A on T.Owner=A.ID WHERE T.ID=".$_REQUEST['Ticket']." order by Priority Desc";
        }else{
            $sql="SELECT T.ID,T.Description,T.Priority,T.Narrative,Customer_Name,T.Title,T.Status,T.Owner,A.user FROM Tickets as T LEFT JOIN admin as A on T.Owner=A.ID WHERE Owner=".$_SESSION['ID']." order by Priority Desc";
        }
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
        <!--469px-->
        <div class="profileBody">

            <!--PHP Load-->
            
                <?php
                    while ($row = mysql_fetch_assoc($result)) {
                        if($row['Status']>1)continue;
                        $Status = array("", "", "", "");
                        $Status[$row['Status']]="selected";

                        echo('
                            <div class="listings">
                                <div class="listing" id="listing'.$row['ID'].'">
                                    <div class="listingHead" onclick="toggleView('.$row['ID'].')">
                                        <span id="listingTitle-'.$row['ID'].'" class="listingHeadTitle left">'.$row['Title'].' - '.$row['Priority'].'</span>
                                        <select class="listingHeadSelect editSelect right" id="Status-'.$row['ID'].'">
                                            <option value="0" '.$Status[0].'>Open</option>
                                            <option value="1" '.$Status[1].'>Pending</option>
                                            <option value="2" '.$Status[2].'>Finished</option>
                                            <option value="3" '.$Status[3].'>Closed</option>
                                        </select>
                                    </div>
                                    <div id="body'.$row['ID'].'" class="listingBody closed">
                                        <div class="listingBodyLeft left">
                                            <table class="profileTable">
                                                <tr><td class="profileTableLabel">Title</td><td><span>'.$row['Title'].'</span></td></tr>
                                                <tr><td class="profileTableLabel">Customer</td><td><span>'.$row['Customer_Name'].'</span></td></tr>
                                               <tr><td class="profileTableLabel">Owner</td><td><span>'.$row['user'].'</span></td></tr>
                                                <tr><td class="profileTableLabel">Priority</td><td><span>'.$row['Priority'].'</span></td></tr>
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


        $("select").change(function(event){
            var element=event.currentTarget;
            var nColumn = $(element).attr("id").split("-")[0];
            var nValue = $(element).val();
            var ID=$(element).attr("id").split("-")[1];


            var thecall = $.ajax({
                type: "POST",
                url: "Ajax/update.php",
                async: true,
                data: {Column:nColumn,Value:nValue, ID:ID },
                dataType: "text",
                complete: function (data) {
                    console.log(data.responseText);
                }
            });
        });
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