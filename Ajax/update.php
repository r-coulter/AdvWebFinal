<?php require_once('../security/DB.php'); ?>
<?php
    //Ajax page used for Async DB updates
    if (!isset($_SESSION)) {
        session_start();
    }

    $Column=stripslashes($_REQUEST['Column']);
    $Column=mysql_real_escape_string($Column);

    $Value=stripslashes($_REQUEST['Value']);
    $Value=mysql_real_escape_string($Value);

    $ID=stripslashes($_REQUEST['ID']);
    $ID=mysql_real_escape_string($ID);

    $sql="";
    $Value2="";

    if($ID!=""){
        if($Column=='Status'){
            if($Value==0){
                $Value2='Open';
                $sql0="UPDATE Tickets SET Owner=0 WHERE ID=".$ID;
            }elseif($Value==1){
                $Value2='Pending';
                $sql0="UPDATE Tickets SET Owner=".$_SESSION['ID']." WHERE ID=".$ID;
            }elseif($Value==2){
                $Value2='Finished';
            }elseif($Value==3){
                $Value2='Closed';
            }
            $result0=mysql_query($sql0);
            //echo(mysql_error());
            $sql="UPDATE Tickets SET Status=".$Value." WHERE ID=".$ID;
        }


        if($Column!=''){
            $result=mysql_query($sql);
        }
    }

    
?>
