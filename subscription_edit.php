<?php 
include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');



?>


<div class = "container-fluid">
    <div class = "card shadow mb- 4">
        <div class = "card-header py -3">
            <h6 class = "m-0 font-weight-bold text-primary"> Edit email adrdress only if it is wrong</h6>
        </div>
    </div class = "card-body">
 <div class="modal-body">
<?php
include 'controller/config.php';

if(isset($_POST['edit_btn']))
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
            
            if (strpos($row['roles'], 'EDIT SUBSCRIBER') !== false) 
            {



                $id = $_POST['edit_id'];
    
                $query = "SELECT * FROM website_subscribe WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                foreach ($query_run as $row ) {
                    
                }
                ?>
            
                        <form action="code.php" method="POST">
                            
                          <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
                          
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                          </div>
                         
            
                          <a href="websitesubscribe.php" class="btn btn-danger" > CANCEL  </a>
                          <button type="submit" name="update_btn" class="btn btn-primary"> Update </button>
            
                      </form>
            
            
                          <?php 
                
            }else{
                header("location: not_allowed_dialog.php");
                exit;
            }
        
        }

    }



    }
    ?>
            </div>
           
</div>
</div>
</div>
</div>





<?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>


