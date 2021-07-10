<?php 
include('security.php');




?>


<div class = "container-fluid">
	<div class = "card shadow mb- 4">
		<div class = "card-header py -3">
			<h6 class = "m-0 font-weight-bold text-primary"> Respond/ Delete Message</h6>
      
<?php
echo '<h4> Still In Development </h4>'
?>

		</div>
	</div class = "card-body">
 <div class="modal-body">
<?php
include 'controller/config.php';

if(isset($_POST['edit_btn']))
{





    
    if(isset ($_SESSION['brands2']))
    {
        $uid =  $_SESSION['brands2'];



        $sql = "SELECT roles FROM admin WHERE id='$uid'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)==0)
        {
            header("location: not_allowed_dialog.php");
            exit;
        }
        while($row = mysqli_fetch_array($result)){
            
            if (strpos($row['roles'], 'RESPOND CONTACT') !== false) 
            {
                


                include ('includes/header.php'); 
                include ('includes/navbar.php');


            $id = $_POST['edit_id'];
            
            $query = "SELECT * FROM website_contact WHERE id='$id' ";
            $query_run = mysqli_query($conn, $query);
            foreach ($query_run as $row ) {
                
            }
            ?>

            <form action="model/test2.php" method="POST">
               <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
              </div>
               <div class="form-group">
                  <label>Message</label>
                  <input type="text" name="message" value="<?php echo $row['message'] ?>" class="form-control" placeholder="Enter Email">
              </div>
              <div class="form-group">
            <label>Message</label>
            <textarea required name="message" class="form-control">
            </textarea>
            </div>
                
           

              <a href="websitecontact.php" class="btn btn-danger" > Cancel </a>
              <button type="submit" name="updatebtn" class="btn btn-primary"> Respond </button>

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


