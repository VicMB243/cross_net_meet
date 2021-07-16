<?php
 include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>


<div class = "container-fluid">
  <div class = "card-header py-3">

  <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#addadminprofile">
       Add Brand Admin 
</button><br/><br/>



    <h6 class = "m-0 font-weight-bold text-primary"> Organisation Information 
    <form action="go7.php" method="POST">
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
                    <option value="2">Suspended</option>
                    <option value="1" >Active</option>
                     <option value="0" >Pending</option>


                  </select>
                </div>
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value=" Generate Report" />
                </div>
                <div class="col-md-2">
                  <input type="button"  class="btn btn-primary btn-sm" value=" Add new employee" data-toggle="modal" data-target="#addemployeeprofile" />
                </div>


                
                
              </div>
            </form>
    

    </h6>
  </div>
  <div class = "card-body">
    <!-- Creating sessions to echo text if it fails or succeceds -->




    <div class = "table-responsive">
     
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           
         
              <th> Name </th>
              <th> Email </th>
              <th> Department</th>
                <th> status </th>
                <th>Action </th>
              
             
           
                
                
          </tr>
        </thead>


         <?php
      
       
if (isset($_SESSION["brands"])) {
  $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run['name'];

 
$sql = "select * from register where organization = '$name'";
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
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['department']; ?></td>
            <td><?php  echo $row['active']; ?></td>
           <td>
              
            
            

                <form action="sub3.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="front_delete_btn2" class="btn btn-danger"    onclick="if (!confirm('Are you sure you want to delete this account?')) { return false }">  DELETE</button>
                </form>
                <?php if ($row['active'] == '0' || $row['active'] == '2'   || $row['active'] == '3'): ?>
                <form action="sub3.php" method="post">
                  <input type="hidden" name="activate2_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="activate2_btn2" class="btn btn-secondary"> Activate</button>
                </form>
                <?php endif ?>
<?php if ($row['active'] == '1'): ?>
                <form action="sub3.php" method="post">
                  <input type="hidden" name="suspend2_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="suspend2_btn2" class="btn btn-primary"   onclick="if (!confirm('Are you sure you want to suspend this account? The user will not have access to the account')) { return false }">Suspend</button>
                </form>
                <?php endif ?>
              </td>

             
          
            
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
}
?>
 <?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>









<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">
      <form action="sub3.php" method="POST">

        

            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control check_email" placeholder="Enter Email">
               <small class="error_emaila" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
           

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn3" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>



<div class="modal fade" id="addemployeeprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">
      <form action="sub3.php" method="POST">

        

      


            
            <div class="form-group">
                <label> Employee name </label>
                <input type="text" name="empname" class="form-control" placeholder="Enter Employee name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control check_email" placeholder="Enter Email">
               <small class="error_emaila" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label> Organization </label>
                <input type="text" name="organization" class="form-control" placeholder="Enter Employee organisation">
            </div>
            <div class="form-group">
                <label> Department </label>
                <input type="text" name="department" class="form-control" placeholder="Enter Department">
            </div>
            
            

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            
           

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn4" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>