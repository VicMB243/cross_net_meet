<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Meeting Violations and accounts Associated with the violations
    

    </h6>
  </div>
<div class = "card-body">
  <div class = "table responsive">
    


    <div class="table-responsive">

    <?php
   

        $query = "SELECT * FROM event
WHERE name  LIKE '%murder%' OR name LIKE '%humantrafficking%' OR name LIKE '%bomb%' or name LIKE '%rape%' or name LIKE '%defilment%' or name LIKE '%cocaine%' or name LIKE '%bhang%' or name LIKE '%meth%' or name LIKE '%assassinations%'or name LIKE '%murder%'or name LIKE '%robbery%' or name LIKE '%theft%' OR description LIKE '%humantrafficking%' OR description LIKE '%bomb%' or description LIKE '%rape%' or description LIKE '%defilment%' or description LIKE '%cocaine%' or description LIKE '%bhang%' or description LIKE '%meth%' or description LIKE '%assassinations%'or description LIKE '%murder%'or description LIKE '%robbery%' or description LIKE '%theft%'";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th> Name </th>
              <th>Description</th>
              
                
      
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
            <td><a href="?uid=<?php echo $row['uid'] ?>"class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                                            <i class="fas fa-hand-point-down"></i>
                                        </span>
                                        <span class="text"></span>
                                    </a>
            </td>
            <td><?php  echo $row['name']; ?></td>
            <td><?php  echo $row['description']; ?></td>
            
       
           
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
if(isset($_GET['uid'])){
?> 
<!-- customer details -->
    <div class="modal fade" id="customerdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table" id="example1">
                        <thead>
      
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                       


                        </thead>
                        <?php
                        $sql = "select * from register where id = '$_GET[uid]'";


                        $res = mysqli_query($conn,$sql);
                        while($row = $res->fetch_assoc()){
                            ?>

                            <tr>
                                
                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['active'] ?></td>
                                <td>
                                  <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn12" class="btn btn-danger"> DELETE</button>
                </form>
                <?php if ($row['active'] == '1'): ?>
                <form action="code.php" method="post">
                    <input type="hidden" name="suspend_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="suspend_btn12" class="btn btn-primary"> Suspend</button>
                </form>
                <?php endif ?>
                                  <td>
                                
                            </tr>

                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
echo"
<script>
  
var myModal = $('#customerdetails');
myModal.modal('show');

</script>
 ";

}

include ('includes/footer.php');
?>