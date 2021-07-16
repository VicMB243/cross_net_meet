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

if(!$_SESSION['brands2'])
{
    header('Location: login.php');
}


if(!$_SESSION['last_login_timestamp'])
{
    header('Location: login.php');
}
else
{

     
    if((time() - $_SESSION['last_login_timestamp']) > 600) 
    {  
        $_SESSION['status'] = "Your session has expired, please login and try again";
        $_SESSION['status_code'] = "error"; 

        session_destroy();
        header('Location: login.php'); 
    }
    else
    {

        $_SESSION['last_login_timestamp'] = time();
            
    }
} 


