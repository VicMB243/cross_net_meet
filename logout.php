<?php
session_start();
if(isset($_POST['logoutbbtn']))
{
    session_destroy();
    unset($_SESSION['brands2']);
    header('Location: login.php');
}

?>

