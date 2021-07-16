<?php
session_start();
include('security.php');
include('update_log.php');
if(isset($_POST['logoutbbtn']))
{


  if (update_log("logout as super admin",$email) ) 
  {
    session_destroy();
    unset($_SESSION['brands2']);
    header('Location: login.php');
  }


    
}

?>

