<?php
include('security2.php');

include ('update_log.php');
include ('brand_admin_roles_validation.php');








if (isset($_POST['registerbtn3'])) {

    


    
        
        
    $uid =  $_SESSION['uid'];
    $brand_id = $_SESSION['brands'];




    
    if (brand_admin_roles_validation('ADD BRAND ADMIN') ) 
    {
        

        
        

        $name = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
       $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
       $datecreated = date("Y-m-d H:i:s");
       $roles = "ADD EMPLOYEE";
   
       $email_query = "SELECT * FROM brand_admins WHERE email = '$email'";
       $email_query_run = mysqli_query($conn, $email_query);
   
       if (mysqli_num_rows($email_query_run) > 0)
       {
        $_SESSION['status'] = "Email Already Taken";
            $_SESSION['status_code'] = "error";
        header ('Location:employee.php');
        
            }
            else {
                
            
            $sql = "INSERT INTO `brand_admins` (`brand_id`,`username`, `email`, `password`,`status`, `datecreated`, `roles`)
             VALUES ('$brand_id','$name','$email', '$password', 'active', '$datecreated', '$roles' )";
        }
        if (mysqli_query($conn,$sql)) {


                if (update_log("Added " .$email. " as a brand admin of organisation ID: ".$brand_id)) 
                {
                   
                            $sql2 = "select * from brand_admins order by id desc";
                            $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
                            $_SESSION['status'] = "Added";
                        $_SESSION['status_code'] = "Success";
                            header("location: employee.php");
                }


        }                 
    }else{
        header("location: not_allowed_dialog.php");
        exit;
    }


}



if (isset($_POST['registerbtn4'])) {


    if(isset ($_SESSION['brands']) && isset ($_SESSION['email']))
    {
        
        
        $uEmail =  $_SESSION['email'];
        $brand_id = $_SESSION['brands'];


        

        
        
            
           if (brand_admin_roles_validation('ADD EMPLOYEE')||brand_admin_roles_validation('ADD REGISTER') ) 
            {
               
               
                
               
                $empname = mysqli_real_escape_string($conn,$_POST['empname']);
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $organization = mysqli_real_escape_string($conn,$_POST['organization']);
                $department = mysqli_real_escape_string($conn,$_POST['department']);
                $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
                
                $val = "1";
                $active = settype($val, "integer");;
                $date = date("Y-m-d");
                $time = date("h:i:sa");


           
               $email_query = "SELECT * FROM register WHERE email = '$email'";
               $email_query_run = mysqli_query($conn, $email_query);
           
               if (mysqli_num_rows($email_query_run) > 0)
               {
                    $_SESSION['status'] = "Email Already Taken";
                    $_SESSION['status_code'] = "error";
                    header ('Location:employee.php');
                
                    }
                    else {


                       // $sql = "INSERT INTO `employee` (`username`,`email`, `active`,`password`) VALUES ('$empname', '$email', '1', '$password')";
  
                    
                        $sqlinsert = "INSERT INTO `register` ( `username`, `email`,`organization`, `department`, `password`,`ddd69075bc4`,`active`,`date`,`time`) 
                        VALUES ('$empname','$email','$organization', '$department','$password','$ddd69075bc4','$active','$date','$time' )";
                        
                    }

               
                
                    if (mysqli_query($conn,$sqlinsert)) {




                        if (update_log("Added employee: " .$empname. ", email: " .$email. "to organisation ".$organization)) 
                        {
                        
                                $sql2 = "select * from register order by id desc";
                                $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
                                $_SESSION['username'] = $res2['id'];
                                $_SESSION['status'] = "Added";
                            $_SESSION['status_code'] = "Success";
                                header("location: employee.php");
                      }


                        
                    }
                    
                
                                    
            }else{
                
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


    
}



if(isset($_POST['activate2_btn2']))


{


    if(isset ($_SESSION['brands']) && isset ($_SESSION['email']))
    {
        
        
        $uEmail =  $_SESSION['email'];
        $brand_id = $_SESSION['brands'];



        if (brand_admin_roles_validation('ACTIVATE EMPLOYEE')||brand_admin_roles_validation('ACTIVATE REGISTER') ) 
        {

               
                $id = $_POST['activate2_id'];

                $query = "UPDATE register SET  active='1' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {

                    if (update_log("Activated account, register ID: ".$id )) 
                    {

                        $_SESSION['status'] = "Account Activated";
                        $_SESSION['status_code'] = "Success";
                            header('Location: employee.php'); 
                    }
                   
                }
                else
                {
                    $_SESSION['status'] = "Account Activation Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: employee.php'); 
                }  
                
                                    
            }else{
                
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}


if(isset($_POST['suspend2_btn2']))
{

    if(isset ($_SESSION['brands']) && isset ($_SESSION['email']))
    {
        
        
        $uEmail =  $_SESSION['email'];
        $brand_id = $_SESSION['brands'];



        if (brand_admin_roles_validation('SUSPEND EMPLOYEE')||brand_admin_roles_validation('SUSPEND REGISTER') ) 
            {

               
                $id = $_POST['suspend2_id'];

                $query = "UPDATE register SET  active='2' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {


                    if (update_log("Suspended account, register ID: ".$id )) 
                    {
                            $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                            header('Location: employee.php'); 
                    }

                    
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: employee.php'); 
                } 
                
                                    
            }else{
                
                header("location: not_allowed_dialog.php");
                exit;
            }
        
    }

}

if(isset($_POST['front_delete_btn2']))
{




    
    if(isset ($_SESSION['brands']) && isset ($_SESSION['email']))
    {
        
        
        $uEmail =  $_SESSION['email'];
        $brand_id = $_SESSION['brands'];


        if (brand_admin_roles_validation('DELETE EMPLOYEE')||brand_admin_roles_validation('DELETE REGISTER') ) 
            {

               
                $id = $_POST['delete_id'];

                $query = "UPDATE register SET  active='3' WHERE id='$id' ";
                 $query_run = mysqli_query($conn, $query);
             
                 if($query_run)
                 {

                    if (update_log("Deleted account, register ID: ".$id )) 
                    {

                        $_SESSION['status'] = "Employee Account Has Been Deleted";
                        $_SESSION['status_code'] = "success";    
                           header('Location: employee.php'); 
                    }

                    
                 }
                 else
                 {
                     $_SESSION['status'] = "Employee Account Hasn't Been Deleted";
                  $_SESSION['status_code'] = "error";        
                     header('Location: employee.php'); 
                 }    
                
                                    
            }
            else{
                
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }
    
}

?>





