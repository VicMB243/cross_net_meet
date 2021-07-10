<?php
 include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>


<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary">Shows information about the Employees who have been deligating meeting and the meetings they have been deligating
 
    

    </h6>
  </div>
  <div class = "card-body">
    <!-- Creating sessions to echo text if it fails or succeceds -->




    <div class = "table-responsive">
     
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Employee Username </th>
          <th> Meeting name </th>
          <th>Description</th>
          <th>Department </th>
              <th> Email Address </th>
              <th> Attendance status </th>
             

               
              
             
           
                
                
          </tr>
        </thead>


         <?php
  $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run['name'];


 $sql = "Select event.*,register.* ,email_address.* from event 
join register on register.id = event.uid 
JOIN email_address on email_address.mid = event.id where email_address.attendance_status LIKE '%will be going in my replacement%' AND register.organization = '$name'";

 //echo $sql;
  $query_run = mysqli_query($conn, $sql);
$res = mysqli_query($conn,$sql);
?>
        
  

        <tbody>
       <?php
       while ( $row=$res->fetch_assoc()) {
         # code...
       ?>
          <tr>
             <td><?php  echo $row['username']; ?></td>
           <td><?php  echo $row['name']; ?></td>
            <td><?php  echo $row['description']; ?></td>
             <td><?php  echo $row['department']; ?></td>
            <td><?php  echo $row['email_address']; ?></td>
            <td><?php  echo $row['attendance_status']; ?></td>
           
          
            
            
          
            
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
</div>
</div>
</div>
</div>




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
      
                        <th>Email</th>
                        <th>Attendance Status</th>
                       


                        </thead>
                        <?php
                        $sql = "select * from email_address where mid = '$_GET[uid]'";


                        $res = mysqli_query($conn,$sql);
                        while($row = $res->fetch_assoc()){
                            ?>

                            <tr>
                                
                                <td>
                                    <?php echo $row['email_address'] ?>
                                </td>
                                <td><?php echo $row['attendance_status'] ?></td>
                                
                            </tr>

                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
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