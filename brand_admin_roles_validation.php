<?php 



function brand_admin_roles_validation($admin_role){


    include 'controller/config.php';

    
    if(isset ($_SESSION['email']))
    {
        
        $email =  $_SESSION['email'];
        $sql = "SELECT * FROM brand_admins WHERE email ='$email'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0)
        {
            return false;
            exit;
            
        }
        while($row = mysqli_fetch_array($result)){
           
            
            
            if (strpos($row['roles'], $admin_role) !== false) 
            {

                return true;
                exit;
            
                                    
            }else{
                return false;
                exit;
                
            }
        
        }

    }else header("location: subscriberlogin.php");
}




?>