<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>
<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Organisation Subscribers
    <form action="go12.php" method="POST">
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
    include 'controller/config.php';
    $date = date('Y-m-d');
    $query = "SELECT * FROM subscription WHERE enddate='$date'  AND payment_status = 'not_paid'";
    $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> ID </th>
              <th>Organisation Details</th>
              <th> Phone</th>
              <th> Package</th>
              <th> Start Date</th>
             <th>End Date</th>
             <th>Status</th>
             <th>Payment Status</th>
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
            <td>
            <a href="?uid=<?php echo $row['organisationid'] ?>"class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-hand-point-down"></i>
                                        </span>
                                        <span class="text"><?php echo $row['organisationid'] ?></span>
                                    </a>
                                  </td>
            <td><?php  echo $row['phone']; ?></td>
             <td><?php  echo $row['package']; ?></td>
            <td><?php  echo $row['startdate']; ?></td>
            <td><?php  echo $row['enddate']; ?></td>
            <td><?php  echo $row['status']; ?></td>
            <td><?php  echo $row['payment_status']; ?></td>
       
            <td>
              
            
            

                <form action="sub2.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="front_delete_btn2" class="btn btn-danger"    onclick="if (!confirm('Are you sure you want to delete this account?')) { return false }">  DELETE</button>
                </form>
                <?php if ($row['status'] == 'pending' || $row['status'] == 'suspended'   || $row['status'] == 'deleted'): ?>
                <form action="sub2.php" method="post">
                  <input type="hidden" name="activate2_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="activate2_btn2" class="btn btn-secondary"> Activate</button>
                </form>
                <?php endif ?>
<?php if ($row['status'] == 'active'): ?>
                <form action="sub2.php" method="post">
                  <input type="hidden" name="suspend2_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="suspend2_btn2" class="btn btn-primary"   onclick="if (!confirm('Are you sure you want to suspend this account? The user will not have access to the account')) { return false }">Suspend</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Organization Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table" id="example1">
                        <thead>
                        
                        <th>Name</th>
                        <th>Email</th>
                       


                        </thead>
                        <?php
                        $sql = "select * from organisation where id = '$_GET[uid]'";


                        $res = mysqli_query($conn,$sql);
                        while($row = $res->fetch_assoc()){
                            ?>

                            <tr>
                                
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td><?php echo $row['email'] ?></td>
                                
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