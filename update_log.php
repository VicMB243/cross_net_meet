<?php 

if(!isset($_SESSION['email'])){
    function update_log($activity,$email){
        include 'controller/config.php';
        
        $dateTime = date('Y-m-d H:i:s');
        $sql_log = "INSERT INTO `admins_log` (`adminEmail`,`activity`, `dateTime`)
        VALUES ('$email','$activity','$dateTime' )";
        if(mysqli_query($conn,$sql_log)):return true; else:return false;endif;
    }
}else{
    function update_log($activity){
        include 'controller/config.php';
        $dateTime = date('Y-m-d H:i:s');
        $email = $_SESSION['email'] ;
    $sql_log = "INSERT INTO `admins_log` (`adminEmail`,`activity`, `dateTime`)
    VALUES ('$email','$activity','$dateTime' )";
    if(mysqli_query($conn,$sql_log)):return true; else:return false;endif;
}
}?>