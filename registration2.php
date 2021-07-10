<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Deleted Admin's
    <form action="go.php" method="POST">
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

    </h6>
  </div>
<div class = "card-body">
  <div class = "table responsive">
    



   

    <div class="table-responsive">

    <?php
 

        $query = "SELECT * FROM admin  WHERE status='deleted'";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th> Username </th>
              <th>Email </th>
              <th>Status</th>
               <th>Date Created</th>
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
            <td><?php  echo $row['username']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['status']; ?></td>
            <td><?php  echo $row['datecreated']; ?></td>

             
             <td>

                

                
           
                
                   <?php if ($row['status'] == 'disabled' || $row['status'] == 'suspended'   || $row['status'] == 'deleted'): ?>
                 <form action="code.php" method="post">
                    <input type="hidden" name="activate_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="activate_btn" class="btn btn-secondary">Activate</button>
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
               "check_submit_btn":1,
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
?>