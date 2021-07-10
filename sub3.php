<?php
include('security2.php');

if(isset($_POST['activate2_btn2']))
{
    $id = $_POST['activate2_id'];

    $query = "UPDATE register SET  active='1' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
         $_SESSION['status'] = "Account Activated";
     $_SESSION['status_code'] = "Success";
        header('Location: employee.php'); 
    }
    else
    {
        $_SESSION['status'] = "Account Activation Failed";
     $_SESSION['status_code'] = "error";       
        header('Location: employee.php'); 
    }    
}
if(isset($_POST['suspend2_btn2']))
{
    $id = $_POST['suspend2_id'];

    $query = "UPDATE register SET  active='2' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
         $_SESSION['status'] = "Account Suspended";
     $_SESSION['status_code'] = "Success";
        header('Location: employee.php'); 
    }
    else
    {
        $_SESSION['status'] = "Suspension Failed";
     $_SESSION['status_code'] = "error";       
        header('Location: employee.php'); 
    }    
}
if(isset($_POST['front_delete_btn2']))
{
    $id = $_POST['delete_id'];

   $query = "UPDATE register SET  active='3' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Employee Account Has Been Deleted";
     $_SESSION['status_code'] = "success";    
        header('Location: employee.php'); 
    }
    else
    {
        $_SESSION['status'] = "Employee Account Hasn't Been Deleted";
     $_SESSION['status_code'] = "error";        
        header('Location: employee.php'); 
    }    
}

?>





?>