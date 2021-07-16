<?php
include('controller/config.php');
if($conn)
{
    // echo "Database Connected";
}
else
{
    header("Location: controller/config.php");
}

if(!$_SESSION['brands'])
{
    header('Location: subscriberlogin.php');
}



if(!$_SESSION['last_login_timestamp'])
{
    header('Location: subscriberlogin.php');
}
else
{

     
    if((time() - $_SESSION['last_login_timestamp']) > 600) 
    {  
            
        session_destroy();
        header('Location: subscriberlogin.php'); 
    }
    else
    {

        $_SESSION['last_login_timestamp'] = time();
            
    }
} 

?>

