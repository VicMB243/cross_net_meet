<?php

 include_once('security.php');
include ('update_log.php');
include ('admin_roles_validation.php');



if (isset($_POST['check_submit_btn'])) 
{
$email = $_POST['email_id'];

 $email_query = "SELECT * FROM admin WHERE email = '$email'";
$email_query_run = mysqli_query($conn, $email_query);

   if (mysqli_num_rows($email_query_run) > 0)
{
    echo"Email Exists. Please Try Another Email";
}

 else {
  echo "Email is Available You Can Use It";
 }

}


if (isset($_POST['check_submit_btn2'])) 
{
$email = $_POST['email_id'];

 $email_query = "SELECT * FROM customers WHERE email = '$email'";
$email_query_run = mysqli_query($conn, $email_query);

   if (mysqli_num_rows($email_query_run) > 0)
{


    echo"Email Exists. Please Try Another Email";
}

 else {
  echo "Email is Available You Can Use It";
 }

}

if (isset($_POST['check_submit_btn7'])) 
{
$email = $_POST['email_id'];

 $email_query = "SELECT * FROM organisation WHERE email = '$email'";
$email_query_run = mysqli_query($conn, $email_query);

   if (mysqli_num_rows($email_query_run) > 0)
{


    echo"Email Exists. Please Try Another Email";
}

 else {
  echo "Email is Available You Can Use It";
 }

}





if (isset($_POST['registerbtn2'])) {





            
            if (admin_roles_validation( 'ADD ADMIN')) 
            {

                
                
                $username = mysqli_real_escape_string($conn,$_POST['username']);
                $email = mysqli_real_escape_string($conn,$_POST['email']);
               $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
           
               $email_query = "SELECT * FROM admin WHERE email = '$email'";
               $email_query_run = mysqli_query($conn, $email_query);
           
               if (mysqli_num_rows($email_query_run) > 0)
               {
                $_SESSION['status'] = "Email Already Taken";
                    $_SESSION['status_code'] = "error";
                header ('Location:registration.php');
                
                    }
                    else {
                       
                        
                    $sql = "INSERT INTO `admin`( `username`, `email`,`password`,  `datecreated`,`status`,`roles`)
                     VALUES ('$username','$email', '$password','$date','active','ADD ORGANISATION' )";
                }
                    if (mysqli_query($conn,$sql)) {


                       
                    




                      if (update_log("Added ".$email." as an organisation/ super admin")) 
                      {
                        $sql2 = "select * from admin order by id desc";
                        $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
                        $_SESSION['username'] = $res2['id'];
                        $_SESSION['status'] = "Added";
                        $_SESSION['status_code'] = "Success";
                        header("location:registration.php");
                      }



                        
                    }
                
                                    
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
       


    
}





if (isset($_POST['register_btn2'])) {

    $username = mysqli_real_escape_string($conn,$_POST['username']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
    
    $email_query = "SELECT * FROM register WHERE email = '$email'";
    $email_query_run = mysqli_query($conn, $email_query);

    if (mysqli_num_rows($email_query_run) > 0)
    {
$_SESSION['status'] = "Email Already Taken";
 $_SESSION['status_code'] = "error";
header ('Location:users2.php');

    }
    else {
    

    
    $sql = "INSERT INTO `register` (`username`,`email`, `active`,`password`) VALUES ('$username', '$email', '1', '$password')";
}
    


    if (mysqli_query($conn,$sql)) {
        $sql2 = "select * from register order by id desc";
        $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
        $_SESSION['username'] = $res2['id'];
        header("location:users2.php");
    }

    
}




if (isset($_POST['sub_btn'])) {

            $email = mysqli_real_escape_string($conn,$_POST['email']);

            $email_query = "SELECT * FROM website_subscribe WHERE email = '$email'";
            $email_query_run = mysqli_query($conn, $email_query);

            if (mysqli_num_rows($email_query_run) > 0)
            {
        $_SESSION['status'] = "Email Already Taken Please Try Another One";
        $_SESSION['status_code'] = "error";
        header ('Location:websitesubscribe.php');

            }
            else {
            
            $sql = "INSERT INTO `website_subscribe`(  `email`) VALUES ('$email')";
        }

            if (mysqli_query($conn,$sql)) {



                        $dateTime = date("Y-m-d H:i:s");
                        $email = $_SESSION['email'];

                        
                      $sql_log = "INSERT INTO `admins_log` (`adminEmail`,`activity`, `dateTime`)
                      VALUES ('$email','ADD SUBSCRIBER','$dateTime' )";


                      if (mysqli_query($conn,$sql_log)) 
                      {
                        
                                $sql2 = "select * from website_subscribe order by id desc";
                                $res2 = mysqli_query($conn,$sql2)->fetch_assoc();    
                            $_SESSION['status'] = "Added";
                            $_SESSION['status_code'] = "Success";
                                
                                header("location:websitesubscribe.php");
                      }



                
            }
  
}


if(isset($_POST['updatebtn']))
{

    if(isset ($_SESSION['uid']))
    {
        
        
        
            
            if (admin_roles_validation('EDIT ADMIN') ) 
            {

                    $id = mysqli_real_escape_string($conn,$_POST['edit_id']);
                    $username = mysqli_real_escape_string($conn,$_POST['edit_username']);
                    $email = mysqli_real_escape_string($conn,$_POST['edit_email']);
                    

                    $query = "UPDATE admin SET username='$username', email='$email' WHERE id='$id' ";
                    $query_run = mysqli_query($conn, $query);

                    if($query_run)
                    {


                        if (update_log("Edited super admin: " .$email)) 
                        {
                        
                                
                            $_SESSION['status'] = "Updated";
                            $_SESSION['status_code'] = "Success";
        
                                header('Location: registration.php'); 
                        }



                    }
                    else
                    {
                        $_SESSION['status'] = "Not Updated";
                        $_SESSION['status_code'] = "error";
                        
                            header('Location: registration.php'); 
                    }
                                    
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

}

if(isset($_POST['update_btn']))
{

    if(isset ($_SESSION['uid']))
    {
        
        $uid =  $_SESSION['uid'];

       
            
            
            if (admin_roles_validation('EDIT SUBSCRIBER') ) 
            {

                $id = mysqli_real_escape_string($conn,$_POST['edit_id']);
                $email = mysqli_real_escape_string($conn,$_POST['edit_email']);
               
               $query = "UPDATE website_subscribe SET  email='$email' WHERE id='$id' ";
               $query_run = mysqli_query($conn, $query);
           
               if($query_run)
               {


                    if (update_log("Edited website subscriber " .$email. " of organisation ID: ".$uid)) 
                    {
                        
                        $_SESSION['status'] = "Updated";
                        $_SESSION['status_code'] = "Success";
                            
                            
                        header('Location: websitesubscribe.php'); 
                    }



               }
               else
               {
                   $_SESSION['status'] = "Not Updated";  
                $_SESSION['status_code'] = "error";
                   
                 
                   header('Location: websitesubscribe.php'); 
               }
                                    
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

}




if(isset($_POST['delete_btn6']))
{

    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];

            if (admin_roles_validation('DELETE CONTACT') ) 
            {


                
                $id = $_POST['delete_id'];

                $query = "UPDATE website_contact  SET status='deleted' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {


                        if (update_log("Deleted website contact of organisation ID: " .$id)) 
                        {
                            
                                    
                            $_SESSION['status'] = "Deleted";
                            $_SESSION['status_code'] = "Success";
                                header('Location: websitecontact.php'); 
                        }

                }
                else
                {
                    $_SESSION['status'] = "Not Deleted";
                $_SESSION['status_code'] = "error";       
                    header('Location: websitecontact.php'); 
                } 
                                    
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }
}


if(isset($_POST['delete_btn7']))
{
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];

        //get current admin's rights from db and perform DELETE operation if he/she is allowed to do so
        //otherwise show the "Not Allowed" dialog and go back to dashboard screen

            if (admin_roles_validation('DELETE ADMIN') ) 
            {

                //perform DELETE operation

                $id = $_POST['delete_id'];

                $query = "UPDATE admin  SET status='deleted' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {




                    $dateTime = date("Y-m-d H:i:s");
                            $email = $_SESSION['email'];

                            
                        $sql_log = "INSERT INTO `admins_log` (`adminEmail`,`activity`, `dateTime`)
                        VALUES ('$email','DELETE SUPER ADMIN','$dateTime' )";


                        if (update_log("Deleted super admin, admin ID: ".$id)) 
                        {
                            
                                    
                            
                            $_SESSION['status'] = "Deleted";
                            $_SESSION['status_code'] = "Success";
                                header('Location: registration.php'); 
                        }



                }
                else
                {
                    $_SESSION['status'] = "Not Deleted";
                $_SESSION['status_code'] = "error";       
                    header('Location: registration.php'); 
                }   

                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

    
}
if(isset($_POST['delete_btn12']))
{
    $id = $_POST['delete_id'];




    if (admin_roles_validation('DELETE REGISTER') ) 
    {



        
                $query = "UPDATE register  SET active='3' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {

            


            if (update_log("Updated status of register ID: ".$id. "to Deleted")) 
            {
                            
                                $_SESSION['status'] = "Deleted";
                                $_SESSION['status_code'] = "Success";
                                header('Location: violations.php'); 
            }


                }
                else
                {
                    $_SESSION['status'] = "Not Deleted";
                $_SESSION['status_code'] = "error";       
                    header('Location: violations.php'); 
                } 



    }else{
        header("location: not_allowed_dialog.php");
        exit;
    }










   
}
if(isset($_POST['delete_btn9']))
{
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];

        
            
            if (admin_roles_validation('SUSPEND REGISTER') ) 
            {

                //perform delete operation

                $id = $_POST['delete_id'];

                $query = "UPDATE register  SET active='3' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run)
                {


                            if (update_log("Updated status of register ID: ".$id. "to Suspended")) 
                            {
                            
                                    $_SESSION['status'] = "Deleted";
                                $_SESSION['status_code'] = "Success";
                                   header('Location: hack.php'); 
                            }




                     
                }
                else
                {
                    $_SESSION['status'] = "Not Deleted";
                 $_SESSION['status_code'] = "error";       
                    header('Location: hack.php'); 
                }    

                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

}

if(isset($_POST['delete_btn8']))
{

    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];

        
            if (admin_roles_validation('DELETE ORGANISATION') ) 
            {
                //perform delete operation

                $id = $_POST['delete_id'];

                $query = "UPDATE organisation  SET status='deleted' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run)
                {

                    if (update_log("Deleted organisation ID: ".$id)) 
                    {
                        
                                $_SESSION['status'] = "Deleted";
                            $_SESSION['status_code'] = "Success";
                                header('Location: add.php'); 
                    }



                }
                else
                {
                    $_SESSION['status'] = "Not Deleted";
                 $_SESSION['status_code'] = "error";       
                    header('Location: add.php'); 
                }   

                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

}


 if(isset($_POST['suspend_btn']))
{


    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


        
            //verify if user has the right and perform SUSPEND operation
            if (admin_roles_validation('SUSPEND ADMIN') ) 
            {
                //perform SUSPEND operation

                $id = $_POST['suspend_id'];

                $query = "UPDATE admin SET  status='disabled' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {



                    if (update_log("Suspended super admin ID: ".$id)) 
                    {
                        
                              
                                $_SESSION['status'] = "Account Suspended";
                            $_SESSION['status_code'] = "Success";
                                header('Location: registration.php');
                    }


 
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: registration.php'); 
                }  

                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}





if(isset($_POST['suspend_btn12']))
{
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];

            
            if (admin_roles_validation('SUSPEND REGISTER') ) 
            {

                //perform suspend operation

                
                $id = $_POST['suspend_id'];

                $query = "UPDATE register SET  active='2' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {



                    if (update_log("Updated status of register ID: ".$id. "to Suspended")) 
                    {
                        
                            $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                            header('Location: violations.php'); 
                    }



                   
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: violations.php'); 
                }    
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}
 if(isset($_POST['suspend_btn10']))
{



    
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];



            
            if (admin_roles_validation('SUSPEND REGISTER') ) 
            {


                //perform suspend operation

                
                
                $id = $_POST['suspend_id'];

                $query = "UPDATE register SET  active='2' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {




                    if (update_log("Updated status of register ID: ".$id. "to Suspended")) 
                    {
                        
                            $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                            header('Location: hack.php'); 
                    }


                   
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: hack.php'); 
                }    
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}
if(isset($_POST['suspend_btn9']))
{


    
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


            
            if (admin_roles_validation('SUSPEND ORGANISATION') ) 
            {




                //perform suspend operation

                
                
                $id = $_POST['suspend_id'];

                $query = "UPDATE organisation SET  status='disabled' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {




                    if (update_log("Suspended organisation ID: ".$id)) 
                    {
                        
                        $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                            header('Location: add.php'); 
                    }

                   
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: add.php'); 
                }       
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}
if(isset($_POST['activate2_btn']))
{




    
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


        if (admin_roles_validation('ACTIVATE CUSTOMER') ) 
        {


                $id = $_POST['activate2_id'];

                $query = "UPDATE customers SET  status='active' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {




                    if (update_log("Activated customer. ID: ".$id)) 
                    {
                        
                                $_SESSION['status'] = "Account Activated";
                        $_SESSION['status_code'] = "Success";
                            header('Location: users.php'); 
                    }




                   
                }
                else
                {
                    $_SESSION['status'] = "Account Activation Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: users.php'); 
                }         
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }



}

 if(isset($_POST['suspend2_btn']))
{



    
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];



        if (admin_roles_validation('SUSPEND CUSTOMER') ) 
        {


                $id = $_POST['suspend2_id'];

                $query = "UPDATE customers SET  status='disabled' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {



                    if (update_log("Suspend customer. ID: ".$id)) 
                    {
                        
                            $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                            header('Location: users.php'); 
                    }

                    
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                $_SESSION['status_code'] = "error";       
                    header('Location: users.php'); 
                }      
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }






      
}
if(isset($_POST['suspend2_btn2']))
{


    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


        if (admin_roles_validation('SUSPEND REGISTER') ) 
        {

                $id = $_POST['suspend2_id'];

                $query = "UPDATE register SET  active='2' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {

                    if (update_log("Updated status of register ID: ".$id. "to Suspended")) 
                    {
                        
                            $_SESSION['status'] = "Account Suspended";
                        $_SESSION['status_code'] = "Success";
                           header('Location: users2.php');  
                    }



                    
                }
                else
                {
                    $_SESSION['status'] = "Suspension Failed";
                 $_SESSION['status_code'] = "error";       
                    header('Location: users2.php'); 
                }     
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}
if(isset($_POST['activate_btn']))
{



    
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


       //verify if user has the right and perform ACTIVATE operation
        if (admin_roles_validation('ACTIVATE ADMIN') ) 
        {



                //perform ACTIVATE operation
                $id = $_POST['activate_id'];

                $query = "UPDATE admin SET  status='active' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {

                    if (update_log("Activated super admin. ID: ".$id)) 
                    {
                            
                                $_SESSION['status'] = "Account Activated";
                            $_SESSION['status_code'] = "Success";
                           header('Location: registration.php');   
                    }
                     
                }
                else
                {
                    $_SESSION['status'] = "Account Suspended";
                 $_SESSION['status_code'] = "error";       
                    header('Location: registration.php'); 
                }  

                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }


if(isset($_POST['activate_btn10']))
{


    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];



        $sql = "SELECT roles FROM admin WHERE id='$uid'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0)
        {
            header("location: not_allowed_dialog.php");
            exit;
        }
        while($row = mysqli_fetch_array($result)){
            
            if (admin_roles_validation('ACTIVATE REGISTER') ) 
            {

                $id = $_POST['activate_id'];

                $query = "UPDATE register SET  active='1' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {



                    if (update_log("Updated status of register ID: ".$id. "to Active")) 
                    {
                        
                            $_SESSION['status'] = "Account Activated";
                        $_SESSION['status_code'] = "Success";
                            header('Location: hack.php');   
                    }



                    
                }
                else
                {
                    $_SESSION['status'] = "Account Suspended";
                $_SESSION['status_code'] = "error";       
                    header('Location: hack.php'); 
                }       
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }





    
}


 if(isset($_POST['activate_btn9']))
{

    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];



        $sql = "SELECT roles FROM admin WHERE id='$uid'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0)
        {
            header("location: not_allowed_dialog.php");
            exit;
        }
        while($row = mysqli_fetch_array($result)){
            
            if (admin_roles_validation('ACTIVATE ORGANISATION') ) 
            {

                $id = $_POST['activate_id'];

                $query = "UPDATE organisation SET  status='active' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {




                    if (update_log("Activated organisation ID: ".$id)) 
                    {
                        
                            $_SESSION['status'] = "Account Activated";
                        $_SESSION['status_code'] = "Success";
                           header('Location: add.php');  
                    }



                     
                }
                else
                {
                    $_SESSION['status'] = "Account Suspended";
                 $_SESSION['status_code'] = "error";       
                    header('Location: add.php'); 
                }       
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }


}

 if(isset($_POST['deletebtn']))
 
{




     
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];



            
            if (admin_roles_validation('DELETE CONTACT') ) 
            {

                $id = $_POST['deleteid'];

                $query = "DELETE FROM _contact WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {



                    if (update_log("Deleted website contacts of organisation ID: ".$uid)) 
                    {
                        
                            $_SESSION['status'] = "Message Deleted";
                        $_SESSION['status_code'] = "Success";
                            header('Location: messages.php');  
                    }




                    
                }
                else
                { 
                    $_SESSION['status'] = "Message Not Deleted";
                $_SESSION['status_code'] = "error";    
                    header('Location: messages.php'); 
                }     
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }


}
if(isset($_POST['eventbtn']))
{




     
    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


            
            if (admin_roles_validation('DELETE EVENT') ) 
            {
                
                $id = $_POST['eventid'];

                $query = "DELETE FROM events WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {


                    if (update_log("Deleted event ID: ".$id." of organisation ID: ".$uid)) 
                    {
                        
                            $_SESSION['status'] = "Message Deleted";
                        $_SESSION['status_code'] = "Success";
                            header('Location: eventdata.php'); 
                    }


                     
                }
                else
                { 
                    $_SESSION['status'] = "Message Not Deleted";
                $_SESSION['status_code'] = "error";    
                    header('Location: eventdata.php'); 
                }       
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }




}


if(isset($_POST['delete_btn']))
{




    if(isset ($_SESSION['uid']))
    {
        $uid =  $_SESSION['uid'];


        if (admin_roles_validation('DELETE SUBSCRIBER') ) 
        {

                
                $id= $_POST['delete_id'];

                $query = "DELETE FROM website_subscribe WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {





                    if (update_log("Deleted website subscriber ID: ".$id." of organisation ID: ".$uid)) 
                    {
                        
                            $_SESSION['status'] = "Email Deleted";
                        $_SESSION['status_code'] = "Success";
                            header('Location: websitesubscribe.php'); 
                    }




                     
                }
                else
                {
                    $_SESSION['status'] = "Email Not Deleted";
                $_SESSION['status_code'] = "error";        
                    header('Location: subscriptions.php'); 
                }     
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        

    }

    
}














if (isset($_POST['register_btn'])) {

     $name = mysqli_real_escape_string($conn,$_POST['name']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $department = mysqli_real_escape_string($conn,$_POST['department']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
    
    $email_query = "SELECT * FROM customers WHERE email = '$email'";
    $email_query_run = mysqli_query($conn, $email_query);

    if (mysqli_num_rows($email_query_run) > 0)
    {
$_SESSION['status'] = "Email Already Taken";
 $_SESSION['status_code'] = "error";
header ('Location:users.php');

    }
    else {
    

    
    $sql = "INSERT INTO `customers` ( `name`, `email`, `status`, `datecreated`, `department`,`password`)
            VALUES ('$name','$email', 'active', '$date','$department','$password' )";
}
    


    if (mysqli_query($conn,$sql)) {



        $sql2 = "select * from customers order by id desc";
        $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
        $_SESSION['username'] = $res2['id'];
        header("location:users.php"); 





        
    }

    
}


if (isset($_POST['clients_btn'])) {

     $name = mysqli_real_escape_string($conn,$_POST['name']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $projectlead = mysqli_real_escape_string($conn,$_POST['projectlead']);
     $company = mysqli_real_escape_string($conn,$_POST['company']);
   
    
    $email_query = "SELECT * FROM clients WHERE email = '$email'";
    $email_query_run = mysqli_query($conn, $email_query);

    if (mysqli_num_rows($email_query_run) > 0)
    {
$_SESSION['status'] = "Email Already Taken";
 $_SESSION['status_code'] = "error";
header ('Location:clients.php');

    }
    else {
    

    
    $sql = "INSERT INTO `clients` ( `name`, `email`,  `datecreated`, `company`, `projectlead`) VALUES ('$name','$email', '$date', '$company','$projectlead')";
}
    


    if (mysqli_query($conn,$sql)) {



                    $dateTime = date("Y-m-d H:i:s");
                    $email = $_SESSION['email'];

                                    
                    $sql_log = "INSERT INTO `admins_log` (`adminEmail`,`activity`, `dateTime`)
                    VALUES ('$email','ADD CLIENT','$dateTime' )";


                    if (mysqli_query($conn,$sql_log)) 
                    {
                        
                        $sql2 = "select * from clients order by id desc";
                        $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
                        header("location:clients.php"); 
                    }




        
    }

    
}


if(isset($_POST['front_delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM customers WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {


                 
        $_SESSION['status'] = "Customer Has Been Deleted";
        $_SESSION['status_code'] = "success";    
            header('Location: users.php'); 
        
    }
    else
    {
        $_SESSION['status'] = "Customer Has Been Deleted";
     $_SESSION['status_code'] = "error";        
        header('Location: users.php'); 
    }    
}


if(isset($_POST['deleteclient_btn']))
{
    $id = $_POST['deleteclient_id'];

    $query = "DELETE FROM clients WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {



                 
        $_SESSION['status'] = "Client Data Has Been Deleted";
        $_SESSION['status_code'] = "success";    
           header('Location: clients.php');  



        
    }
    else
    {
        $_SESSION['status'] = "Client Data Has Not Been Deleted";
     $_SESSION['status_code'] = "error";        
        header('Location: clients.php'); 
    }    
}
if(isset($_POST['front_updatebtn']))
{
$id = mysqli_real_escape_string($conn,$_POST['edit_id']);
    $name = mysqli_real_escape_string($conn,$_POST['edit_name']);
     $email = mysqli_real_escape_string($conn,$_POST['edit_email']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['edit_password']));

   

    $query = "UPDATE customers SET name='$name', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data  Has Been Edited";
     $_SESSION['status_code'] = "success";      
    
        header('Location: users.php'); 
    }
    else
    {
        $_SESSION['status'] = "Data  Has Not  Been Edited";
     $_SESSION['status_code'] = "success";  
      
        header('Location: users.php'); 
    }
}
if(isset($_POST['updateevent_btn']))
{
$id = mysqli_real_escape_string($conn,$_POST['edit_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['edit_fname']);
     $lname = mysqli_real_escape_string($conn,$_POST['edit_lname']);
     $email = mysqli_real_escape_string($conn,$_POST['edit_email']);
      $phoneno = mysqli_real_escape_string($conn,$_POST['edit_phoneno']);
    
   

    $query = "UPDATE events SET fname='$fname', lname='$lname', email='$email', phoneno='$phoneno' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data  Has Been Edited";
     $_SESSION['status_code'] = "success";      
    
        header('Location: eventdata.php'); 
    }
    else
    {
        $_SESSION['status'] = "Data  Has Not  Been Edited";
     $_SESSION['status_code'] = "success";  
      
        header('Location: eventdata.php'); 
    }
}

if(isset($_POST['updateclient_btn']))
{
$id = mysqli_real_escape_string($conn,$_POST['edit_id']);
    $name = mysqli_real_escape_string($conn,$_POST['edit_name']);
     $email = mysqli_real_escape_string($conn,$_POST['edit_email']);
     $company = mysqli_real_escape_string($conn,$_POST['edit_company']);
      $projectlead = mysqli_real_escape_string($conn,$_POST['edit_projectlead']);
    
   

    $query = "UPDATE clients SET name='$name', email='$email', company='$company', projectlead='$projectlead' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data  Has Been Edited";
     $_SESSION['status_code'] = "success";      
    
        header('Location: clients.php'); 
    }
    else
    {
        $_SESSION['status'] = "Data  Has Not  Been Edited";
     $_SESSION['status_code'] = "success";  
      
        header('Location: clients.php'); 
    }
}


if(isset($_POST['delete_brand_btn']))
{
    $brand_id = $_POST['delete_id'];

    $query = "DELETE FROM brand WHERE brand_id ='$brand_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Data Deleted";
     $_SESSION['status_code'] = "success";  
        header('Location: brand.php'); 
    }
    else
    {
         $_SESSION['status'] = "Product Data Not Deleted";
     $_SESSION['status_code'] = "error";       
        header('Location: brand.php'); 
    }    
}

if(isset($_POST['search_data']))
{
    $brand_id = $_POST['brand_id'];
    $visible = $_POST['visible'];

   

$query = "UPDATE brand SET visible = '$visible' WHERE brand_id= '$brand_id' ";
$query_run = mysqli_query($conn, $query);

}



 if(isset($_POST['delete_multiple_brand_data']))
{
    $id = "1";

    $query = "DELETE FROM brand WHERE visible='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {


        $_SESSION['status'] = "Data  Has Been Deleted";
        $_SESSION['status_code'] = "success";  
           header('Location: brand.php'); 


         
    }
    else
    {
     $_SESSION['status'] = "Data  Has Not Been Edited";
     $_SESSION['status_code'] = "success";         
        header('Location: brand.php'); 
    }    
}


if(isset($_POST['search_data2']))
{
    $p_id = $_POST['p_id'];
    $visible = $_POST['visible'];

$query = "UPDATE brandproducts SET visible = '$visible' WHERE p_id= '$p_id' ";
$query_run = mysqli_query($conn, $query);

}


if(isset($_POST['delete_multiple_data']))
{
    $id2 = "1";

    $query = "DELETE FROM brandproducts WHERE visible='$id2' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
         $_SESSION['status'] = "Data  Has Been Deleted";
     $_SESSION['status_code'] = "success";  
        header('Location: products2.php'); 
    }
    else
    {
     $_SESSION['status'] = "Data  Has Not Been Edited";
     $_SESSION['status_code'] = "success";         
        header('Location: products2.php'); 
    }    

}




    if(isset($_POST['delete_product_btn2']))
{
    $p_id = $_POST['delete_id2'];

    $query = "DELETE FROM brandproducts WHERE p_id ='$p_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Product Data Deleted";
     $_SESSION['status_code'] = "success";  
        header('Location: products2.php'); 
    }
    else
    {
         $_SESSION['status'] = "Product Data Not Deleted";
     $_SESSION['status_code'] = "error";       
        header('Location: products2.php'); 
    }   

    } 




?>





