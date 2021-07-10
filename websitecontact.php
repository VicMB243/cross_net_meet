
<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');

    
   
  




?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
      <form action="code.php" method="POST">

        

            
            
           
        </div>
       
      </form>

    </div>
  </div>
</div>
<div class ="container-fluid">
  <!--Datatales Example -->
  <div class = "card shadow mb-4"
  <div class= "card-heaader py-3">
    <h6 class "m-0 font-weight-bold text-primary"> Messages


</h6>
</div>
<div class = "card-body">
  <div class = "table responsive">
    

<div class="table-responsive">


<?php
    include 'controller/config.php';

        $query = "SELECT * FROM website_contact WHERE NOT status='deleted'";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              
              <th> name </th>
              <th>email </th>
              <th>message</th>
                <th>phone</th>
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
           
            <td><?php  echo $row['name']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['message']; ?></td>
             <td><?php  echo $row['phone']; ?></td>
               
       
            <td>
                <form action="message_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> Respond</button>
                </form>
            
            

                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn6" class="btn btn-danger"> DELETE</button>
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