<?php
session_start();



if(isset($_POST['logout_btn']))
{



    if (update_log("logout as brand admin",$email) ) 
  {
    session_destroy();
    unset($_SESSION['brands']);
    header('Location: subscriberlogin.php');
  }


    
}

?>

