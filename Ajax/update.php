<?php require_once('../security/DB.php'); ?>
<?php
    $Column=stripslashes($_REQUEST['Column']);
    $Column=mysql_real_escape_string($Column);

    $Value=stripslashes($_REQUEST['Value']);
    $Value=mysql_real_escape_string($Value);

    $ID=stripslashes($_REQUEST['ID']);
    $ID=mysql_real_escape_string($ID);

    $sql="";
    if($ID!=""){
        if($Column=='Status'){
            $sql="UPDATE Tickets SET Status=".$Value." WHERE ID=".$ID;
        }
        if($Column!=''){
            $result=mysql_query($sql);

            if (!$result) {
                die('Invalid query: ' . mysql_error());
            }
        }
    }

    
?>
