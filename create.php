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
                <a class="navHeaderLink left">All Tickets</a><a class="navHeaderLink left current">New Ticket</a><a class="contactButton right" onclick="">Log Out</a>
            </div>
        </div>

        <div class="profileBody">
            <div class="profileFormDiv left">
                <table class="profileTable">
                    <tr><td class="profileTableLabel">Title</td><td><input class="inputWidth editText" id="fName" type="text" value=""></td></tr>
                    <tr><td class="profileTableLabel">Customer</td><td><input class="inputWidth  editText" id="lName" type="text" value=""></td></tr>
                    <tr><td class="profileTableLabel">Owner</td><td>
                        <div><select id="owner" class="inputWidth editSelect">
                            <option selected></option>
                            <option>Me</option>
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
                    <tr>
                        <td class="profileTableLabel" style="position: relative;top: -100px;">Description</td>
                        <td><textarea id="instructions" class="editText" maxlength="325"></textarea></td>
                    </tr>

                </table>
            </div>
        </div>

    </body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>
    var mode=0;
    $(document).ready(function () {   
        
   
    });

    /*Ad size
    Single Listing Feature Ad
    Quarter Page Ad (Max 3 listings)
    Half Page Ad (Max 8 listings)
    Full Page Ad (Max 16 listings)
    Double Page Spread (Max 32 listings)
    */

    /*Payment options
    Bill My Office
    Cheque
    Visa or Mastercard
    */



</script>

<script>

</script>