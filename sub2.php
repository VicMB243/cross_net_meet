<?php
include('security.php');












if (isset($_POST['package'])) 
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
            
            if (strpos($row['roles'], 'ADD SUBSCRIPTION') !== false) 
            {
   
                if (isset($_POST['category'])) {
                    if ($_POST['category']== 'Monthly'){
                    $newdate=date_create();
                    date_add($newdate,date_interval_create_from_date_string("1 month"));
                    $newdate = $newdate->format('Y-m-d');
                    }
                    if ($_POST['category']== 'Quartely'){
                    $newdate=date_create();
                    date_add($newdate,date_interval_create_from_date_string("3 months"));
                    $newdate = $newdate->format('Y-m-d');
                    }
                    if ($_POST['category']== 'Annually'){
                    $newdate=date_create();
                    date_add($newdate,date_interval_create_from_date_string("1 month"));
                    $newdate = $newdate->format('Y-m-d');
                    }
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $name = mysqli_real_escape_string($conn,$_POST['name']);
                    $email = mysqli_real_escape_string($conn,$_POST['email']);
                    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
                    $category = mysqli_real_escape_string($conn,$_POST['category']);
                    
                    
                    $sql = "INSERT INTO `subscription` ( `phone`, `package`, `startdate`, `enddate`,`status`,`organisationid`) VALUES ('$phone', '$category','$date','$newdate', 'pending', '$id')";
                        if (mysqli_query($conn,$sql)) {
                            $sql2 = "select * from subscription order by id desc";
                            $res2 = mysqli_query($conn,$sql2)->fetch_assoc();
                    $_SESSION['subscribe'] = $res2['id'];
                            if($res2)
                    {
                    
                       $_SESSION['pendig'] = $res2['id'];
                    
                       header ('Location:users2.php');
                    
                    }
                    }
                    }
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }

}

if(isset($_POST['activate2_btn2']))
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
            
            if (strpos($row['roles'], 'ACTIVATE SUBSCRIPTION') !== false) 
            {
                $id = $_POST['activate2_id'];

                $query = "UPDATE subscription SET  status='active' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {
                     $_SESSION['status'] = "Account Activated";
                 $_SESSION['status_code'] = "Success";
                    header('Location: users2.php'); 
                }
                else
                {
                    $_SESSION['status'] = "Account Activation Failed";
                 $_SESSION['status_code'] = "error";       
                    header('Location: users2.php'); 
                }    
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }


    
}








if(isset($_POST['suspend2_btn2']))
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
            
            if (strpos($row['roles'], 'SUSPEND SUBSCRIPTION') !== false) 
            {
                $id = $_POST['suspend2_id'];

                $query = "UPDATE subscription SET  status='suspended' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                if($query_run)
                {
                    $_SESSION['status'] = "Account Suspended";
                $_SESSION['status_code'] = "Success";
                    header('Location: users2.php'); 
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


      
}
if(isset($_POST['front_delete_btn2']))
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
            
            if (strpos($row['roles'], 'DELETE SUBSCRIPTION') !== false) 
            {
                $id = $_POST['delete_id'];

                    $query = "UPDATE subscription SET  status='deleted' WHERE id='$id' ";
                    $query_run = mysqli_query($conn, $query);

                    if($query_run)
                    {
                        $_SESSION['status'] = "Customer Has Been Deleted";
                    $_SESSION['status_code'] = "success";    
                        header('Location: users2.php'); 
                    }
                    else
                    {
                        $_SESSION['status'] = "Customer Has Been Deleted";
                    $_SESSION['status_code'] = "error";        
                        header('Location: users2.php'); 
                    }     
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }






       
}
if(isset($_POST['front_delete_btn3']))
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
            
            if (strpos($row['roles'], 'DELETE SUBSCRIPTION') !== false) 
            {
                $id = $_POST['delete_id'];

                $query = "UPDATE subscription SET  status='deleted' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {
                    $_SESSION['status'] = "Subscription Has Been Deleted";
                $_SESSION['status_code'] = "success";    
                    header('Location: users2.php'); 
                }
                else
                {
                    $_SESSION['status'] = "Customer Has Been Deleted";
                $_SESSION['status_code'] = "error";        
                    header('Location: users2.php'); 
                }  
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }













       
}

?>