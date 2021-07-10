<?php
session_start();



if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['brands']);
    header('Location: subscriberlogin.php');
}

?>

