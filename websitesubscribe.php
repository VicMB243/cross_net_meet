<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a subscribers to email list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="code.php" method="POST">

        

            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control " placeholder="Enter Email">
                
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="sub_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class ="container-fluid">
  <!--Datatales Example -->
  <div class = "card shadow mb-4"
  <div class= "card-heaader py-3">
    <h6 class "m-0 font-weight-bold text-primary"> Subscribers List 

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
       Add email of the subscriber
</button>
</h6>
</div>
<div class = "card-body">
  <div class = "table responsive">
    



    
    <div class="table-responsive">

    <?php
    include 'controller/config.php';

        $query = "SELECT * FROM website_subscribe";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th>Email </th>
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
               ?>
          <tr>
            <td><?php  echo $row['id']; ?></td>
            <td><?php  echo $row['email']; ?></td>
          
       
            <td>
                <form action="subscription_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            
            

                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
          <?php
            } 
        }
        else {
            echo "No Record Found";
        }
        ?>
        </tbody>
      </table>
   
    </div>
  </div>
</div>

</div>
</div>
<!-- /.container-fluid -->


<?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>