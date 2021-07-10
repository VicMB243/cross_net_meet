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
?>

