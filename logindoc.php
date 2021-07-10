<?php
include 'controller/config.php';

if(isset($_POST["loginbbtn"])){
 
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password=md5(mysqli_real_escape_string($conn,$_POST["password"])); 
  
  $sql="SELECT * FROM admin WHERE email='$email' and status = 'active'";  
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  
  $emaill=$row['email'];
  $passwordd=$row['password'];

if($email==$emaill && $password==$passwordd){
      $_SESSION['brands2'] = $row['id'];
      $_SESSION['uid'] = $row['id'];
      $_SESSION['status'] = "Welcome to your Dashboard";
     $_SESSION['status_code'] = "Success";
header("location:index.php");
    
  }
  else{
    $_SESSION['status'] = "Email or Password Dont Match or Account is not active ";
     $_SESSION['status_code'] = "error";
      
        header('Location: login.php'); 
  }
  

}
?>

