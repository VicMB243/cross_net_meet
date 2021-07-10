<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Potentially Hack or Red Flag accounts
    <form action="go11.php" method="POST">
              <div class="row">
             
                <div class="col-md-4">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
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
   

        $query = "SELECT * FROM register
WHERE username LIKE '%test%' OR username LIKE '%dummy%' OR username LIKE '%user%' or username LIKE '%example%' or username LIKE '%hack%' or username LIKE '%Tttttttr43333%' or username LIKE '%username%' or username LIKE '%guest%' or username LIKE '%adm%'or username LIKE '%mysql%'or username LIKE '%administrator%' or username LIKE '%oracle%' OR email LIKE '%dummy%' OR email LIKE '%user%' or email LIKE '%example%' or email LIKE '%hack%' or email LIKE '%Tttttttr43333%' or email LIKE '%username%' or email LIKE '%guest%' or email LIKE '%adm%'or email LIKE '%mysql%'or email LIKE '%administrator%' or email LIKE '%test%' or email LIKE '%oracle%'";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th> Name </th>
              <th>Email</th>
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
            <td>
              <?php  echo $row['id']; ?>
            </td>
            <td><?php  echo $row['username']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['active']; ?></td>
             <td>

                 <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn9" class="btn btn-danger"> DELETE</button>
                </form>

                
           <?php if ($row['active'] == '1'): ?>
                <form action="code.php" method="post">
                    <input type="hidden" name="suspend_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="suspend_btn10" class="btn btn-primary"> Suspend</button>
                </form>
                <?php endif ?>
                
                   <?php if ($row['active'] == '0' || $row['active'] == '2'   || $row['active'] == '3'): ?>
                 <form action="code.php" method="post">
                    <input type="hidden" name="activate_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="activate_btn10" class="btn btn-secondary">Activate</button>
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