<?php 
session_start();
include('controller/config.php');
if (isset($_SESSION['changepwd'])) {
if (isset($_GET['s'])) {
$email = mysqli_real_escape_string($conn,$_GET['s']);
$sql = "select * from organisation where email = '$email'";
$res = mysqli_query($conn,$sql);
if (mysqli_num_rows($res) == 1) {
$row = $res->fetch_assoc();
$_SESSION['brands'] = $row['id'];
unset($_SESSION['changepwd']);
header("location:https://crossnetmeet.com/admin/change.php?changepwd");
}else{
 $_SESSION['status'] = "Error";
     $_SESSION['status_code'] = "error";       
        header('Location: index2.php'); 
    }    

}
}else{
	$_SESSION['status'] = "Error";
     $_SESSION['status_code'] = "error";       
        header('Location: index2.php'); 
}

?>