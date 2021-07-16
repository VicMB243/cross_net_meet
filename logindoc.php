<?php
include 'controller/config.php';
include_once 'update_log.php';

if(isset($_POST["loginbbtn"])){
 
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password=md5(mysqli_real_escape_string($conn,$_POST["password"])); 
  
  $sql="SELECT * FROM admin WHERE email='$email' and status = 'active'";  
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  
  $emaill=$row['email'];
  $passwordd=$row['password'];

if($email==$emaill && $password==$passwordd){
      
     
      
     if (update_log("Login as super admin",$email) ) 
     {
            $_SESSION['brands2'] = $row['id'];
            $_SESSION['brands'] = $row['id'];
            $_SESSION['uid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['last_login_timestamp'] = time();
            $_SESSION['status'] = "Welcome to your Dashboard";
        $_SESSION['status_code'] = "Success";
          header("location:index.php");
     }


//header("location:index.php");
    
  }
  else{
    $_SESSION['status'] = "Email or Password Dont Match or Account is not active ";
     $_SESSION['status_code'] = "error";
      
        header('Location: login.php'); 
  }
  

}
?>

