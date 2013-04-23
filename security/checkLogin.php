<?php require_once('../security/DB.php'); ?>
<?php
    
    /*    
Author: Ryan Coulter
Web site name: AdvWebFinal
Description: Login Backend page
*/

//initialize the session
if (!isset($_SESSION)) {
    session_start();
}



// username and password sent from login page 
$myusername=$_POST['user']; 
$mypassword=$_POST['password']; 

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $usr_tbl_name WHERE user='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Count results
$count=mysql_num_rows($result);

// if user/pass is found, results must be 1
if($count==1){

// Save user/pass and redirect to myContacts
$_SESSION['user']=$myusername;
$_SESSION['pass']=$mypassword;
$_SESSION['error']="";
$row=mysql_fetch_assoc($result);
$_SESSION['ID']=$row['ID'];
header("location: ..\search.php");
}
else {
// Incorrect password, pass the error back to login
$_SESSION['error']="Wrong Username or Password";
header("location: ..\login.php");
}
?>