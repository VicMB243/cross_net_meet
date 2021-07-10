<?php 
include '../../controller/config.php';
foreach($_POST['acs'] as $key => $value){
    echo $key." ".$value."<br>";
}
?>