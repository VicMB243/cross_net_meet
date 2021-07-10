<?php 
include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');



?>


<div class = "container-fluid">
	<div class = "card shadow mb- 4">
		<div class = "card-header py -3">
			<h6 class = "m-0 font-weight-bold text-primary"> Edit Admin Profile</h6>
		</div>
	</div class = "card-body">
 <div class="modal-body">
<?php
 include ('database/dbconfig.php');

if(isset($_POST['edit_organisation']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM organisation WHERE id='$brand_id' ";
    $query_run = mysqli_query($conn, $query);
    foreach ($query_run as $row ) {
    	
    }
    ?>

            <form action="code2.php" method="POST"   enctype="multipart/form-data">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['brand_id'] ?>" >
              
              <div class="form-group">
                  <label> Brand Name </label>
                  <input type="text" name="edit_brandname" value="<?php echo $row['brandname'] ?>" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                  <label> Username </label>
                  <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
              </div>
               <div class="form-group">
                  <label>Mobile</label>
                  <input type="text" name="edit_mobile" value="<?php echo $row['mobile'] ?>" class="form-control" placeholder="Enter Mobile">
              </div>
               <div class="form-group">
                  <label>Location</label>
                  <input type="text" name="edit_location" value="<?php echo $row['location'] ?>" class="form-control" placeholder="Enter Location">
              </div>
               <div class="form-group">
                  <label>Description</label>
                  <input type="text" name="edit_description" value="<?php echo $row['description'] ?>" class="form-control" placeholder="Enter Description">
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password" >
              </div>
               <div class="form-group">
                  <label>Logo</label>
                  <input type="file" name="images" value="<?php echo $row['images'] ?>" class="form-control" placeholder="Enter Logo" >
              </div>
               <div class="form-group">
                  <label>Banner</label>
                  <input type="file" name="banner" value="<?php echo $row['banner'] ?>" class="form-control" placeholder="Enter Banner" >
              </div>
              
              <a href="brand.php" class="btn btn-danger" > CANCEL  </a>
              <button type="submit" name="updatebtn6" class="btn btn-primary"> Update </button>

          </form>


              <?php
}
    
    ?>
            </div>
           
</div>
</div>
</div>
</div>

</div>



<?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>


