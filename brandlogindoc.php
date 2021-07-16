<?php
include 'controller/config.php';
include_once 'update_log.php';

if(isset($_POST["login_btn"])){

 $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password=md5(mysqli_real_escape_string($conn,$_POST["password"])); 
  
  $sql="SELECT * FROM organisation WHERE email='$email' AND status='active'";  
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  
  $emaill=$row['email'];
  $passwordd=$row['password'];

if($email==$emaill && $password==$passwordd){
      



  
  if (update_log("Login as super admin",$email) ) 
  {

    
  
          $_SESSION['brands'] = $row['id'];
          $_SESSION['brands2'] = $row['id'];
          $_SESSION['uid'] = $row['id'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['last_login_timestamp'] = time();
          $_SESSION['status'] = "Welcome to your Dashboard";
      $_SESSION['status_code'] = "Success";
        header("location:index2.php");
  }
  }
  else{
    $_SESSION['status'] = "Email or Password Dont Match ";
     $_SESSION['status_code'] = "error";
      
        header('Location: subscriberlogin.php'); 
    
  }
  

}
?>

