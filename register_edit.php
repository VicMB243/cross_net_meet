<?php 
include('security.php');




?>


<div class = "container-fluid">
	<div class = "card shadow mb- 4">
		<div class = "card-header py -3">
			<h6 class = "m-0 font-weight-bold text-primary"> Edit Admin Profile</h6>
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


        //get current admin's rights from db and perform EDIT operation if allowed to do so
        //otherwise show the "Not Allowed" dialog and go back to dashboard screen

        $sql = "SELECT roles FROM admin WHERE id='$uid'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0)
        {
            header("location: not_allowed_dialog.php");
            exit;
        }
        while($row = mysqli_fetch_array($result)){
            //verify if user has the right and perform EDIT operation
            if (strpos($row['roles'], 'EDIT ADMIN') !== false) 
            {


                include ('includes/header.php'); 
                include ('includes/navbar.php');


                //perform EDIT operation

                $id = $_POST['edit_id'];
    
                $query = "SELECT * FROM admin WHERE id='$id' ";
                $query_run = mysqli_query($conn, $query);
                foreach ($query_run as $row ) {
                    
                }
                ?>
            
                        <form action="code.php" method="POST">
                            
                          <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
                          
                          <div class="form-group">
                              <label> Username </label>
                              <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                          </div>
                          
                           
            
                          <a href="registration.php" class="btn btn-danger" > CANCEL  </a>
                          <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
            
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


