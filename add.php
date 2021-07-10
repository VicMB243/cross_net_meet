<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>




<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add An Orginisation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">
      <form action="code.php" method="POST">

        

            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control check_email" placeholder="Enter Email">
               <small class="error_emaila" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label> Name </label>
                <input type="text" name="name" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn2" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class ="container-fluid">
  <!--Datatales Example -->
  <div class = "card shadow mb-4">
  <div class= "card-heaader py-3">
    <h6 class= "m-0 font-weight-bold text-primary">Organisation
</h6>
<button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#addadminprofile">
       Add an Organisation
</button>

<form action="gopro.php" method="POST">
              <div class="row">
             
                <div class="col-md-4">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                </div>
                 <div class="col-md-4">
                  <select name="custom" class="form-control input-sm">
                   <option >All</option>
                    <option >Suspended</option>
                    <option >Pending</option>
                    <option >Active</option>

                  </select>
                </div>
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value=" Generate Report" />
                </div>
              </div>
            </form>
</div>
<div class = "card-body">
  <div class = "table responsive">
    



   

    <div class="table-responsive">

    <?php
 

        $query = "SELECT * FROM organisation";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th> Name</th>
              <th>Email </th>
              <th>Status</th>
              <th>Action </th>
                
      
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
            <td><?php  echo $row['name']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['status']; ?></td>
            
             
             <td>
              <a href="?addproduct=<?php echo $row['id'] ?>"class = "btn btn-primary"  >add Organisation Subscription</a>

                 <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn8" class="btn btn-danger"> DELETE</button>
                </form>

                
           <?php if ($row['status'] == 'active'): ?>
                <form action="code.php" method="post">
                    <input type="hidden" name="suspend_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="suspend_btn9" class="btn btn-primary"> Suspend</button>
                </form>
                <?php endif ?>
                
                   <?php if ($row['status'] == 'disabled' || $row['status'] == 'suspended'   || $row['status'] == 'deleted'): ?>
                 <form action="code.php" method="post">
                    <input type="hidden" name="activate_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="activate_btn9" class="btn btn-secondary">Activate</button>
                </form>
                <?php endif ?>
                 

            
             
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </div>
  </div>
</div>

</div>
</div>
<!-- /.container-fluid -->


<?php 
include ('includes/scripts.php');
?> 
<script>
$(document).ready(function() {

  $('.check_email').keyup(function(e){

//alert ("hello am working");
var email = $('.check_email').val();
   //alert (email);

   $.ajax ({
          type: "POST",
          url:  "code.php",
          data:{
               "check_submit_btn7":1,
               "email_id": email,
           },
          
          success: function (response){
         
        //alert (response);
        $('.error_emaila').text(response);

          }
      });

});
});
</script>
<script>
$(document).ready(function(){
 $('#convert').click(function(){
    var table_content = '<table>';
    dataTable += $('#dataTable').html();
    dataTable += '</table>';
    $('#file_content').val(table_content);
    $('#convert_form').submit();
  });
});
</script>
<?php
include ('includes/footer.php');
include('addproduct.php');
if(isset($_GET['addproduct'])){
echo"
<script>
  
var myModal = $('#addproduct');
myModal.modal('show');

</script>
 ";

}
?>
