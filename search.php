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
                <a href="" class="navHeaderLink left current">All Tickets</a><a class="navHeaderLink left">My Tickets</a><a class="contactButton right" onclick="">Log Out</a>
            </div>
        </div>

        <div class="searchHeader">
            <input type="text" id="searchInput" class="left" placeholder="Search"><img id="searchBtn" class="left" src="Images/search.png" onclick="search()">
            <span class="agentCount right">0 Tickets</span>

           
        </div>

        <div class="tableDiv">
            <table id="listTable2">
                <tr class="headerRow">
                        <td class="clmPriority">Priority</td>
                        <td class="clmTitle">Title</td>
                        <td class="clmCustomer">Customer</td>
                        <td class="clmStatus">Status</td>
                        <td class="clmClaim">Claim</td>
                    </tr>
                <!--Repeat with PHP-->
                    <tr class="row">
                        <td class="clmPriority clm"></td>
                        <td class="clmTitle clm"></td>
                        <td class="clmCustomer clm"></td>
                        <td class="clmStatus clm"></td>
                        <td class="clmClaim clm"></td>
                    </tr>
                <!--/PHP-->
            </table>
        </div>
    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>
    $(document).ready(function () {          
        $("#searchInput").keyup(function(event){
            if(event.keyCode == 13){
                search();
            }
        });
    });

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
    }

    function claimTicket(_id){
        var thecall = $.ajax({
            type: "POST",
            url: "/Ajax/claimTicket.php",
            async: true,
            data: {theID:_id},
            dataType: "text",
            complete: function (data) {
                document.location.reload(true);
            }
        });
    }
</script>