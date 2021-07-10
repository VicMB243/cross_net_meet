<?php 
include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');



?>


<div class = "container-fluid">
  <div class = "card shadow mb- 4">
    <div class = "card-header py -3">
      <h6 class = "m-0 font-weight-bold text-primary"> Change Password </h6>
    </div>
  </div class = "card-body">
 <div class="modal-body">
<?php
 include 'controller/config.php';

if (isset($_SESSION['brands'])) {
{

    $edit_id = $_SESSION['brands'];
    
    $query = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
    $query_run = mysqli_query($conn, $query);
    $row = mysqli_query($conn,$query)->fetch_assoc();
    


    
    ?>

            <form action="change2.php" method="POST"   enctype="multipart/form-data">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
              
              
              
              
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="edit_password"  class="form-control" placeholder="Enter Password"  >
              </div>
              
              
               
              
              
              <a href="change.php" class="btn btn-danger" > CANCEL  </a>
              <button type="submit" name="change_btn" class="btn btn-primary"> Update </button>

          </form>


              <?php

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


