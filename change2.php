<?php

include('security2.php');


if(isset($_POST['change_btn']))
{
$edit_id= $_POST['edit_id'];
$edit_password = md5(mysqli_real_escape_string($conn,$_POST['edit_password']));




$query = "UPDATE organisation SET password='$edit_password'
WHERE id='$edit_id' ";
    $query_run = mysqli_query($conn, $query);

if($query_run)
{


    $_SESSION['status'] = "Password Changed";
     $_SESSION['status_code'] = "success";  
    header ('Location:customeraccountinfo.php');

}
else{
 $_SESSION['status'] = "Password Not Changed";
     $_SESSION['status_code'] = "error";  
 header ('Location:change.php');
}
}


 





?>
