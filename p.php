<?php
 include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>


<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Show the number of People Who did not Accept Meeting Invites Per Department in General
      <form action="go9.php" method="POST">
        <br>

              <div class="row">
                <input type="hidden" name="mid" value= "<?php  echo $row['id']; ?>">
                <input type="hidden" name="name" value= "<?php  echo $row['name']; ?>">
             
                <div class="col-md-4">
                  <select name="file_type" class="form-control input-sm">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                </div>
                
                <div class="col-md-2">
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value=" Generate Attendee Report" />
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
           
         
              <th> Number </th>
              <th> Department </th>
               
              
             
           
                
                
          </tr>
        </thead>


         <?php
      
       
if (isset($_SESSION["brands"])) {
  $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run['name'];

 
$sql = "SELECT COUNT(email_address.id) AS COUNT,register.department FROM event JOIN email_address ON event.id = email_address.mid JOIN register ON register.id = event.uid WHERE email_address.attendance_status IS NULL AND register.organization = '$name' GROUP BY register.department ";
$query_run = mysqli_query($conn, $sql);
$res = mysqli_query($conn,$sql);
?>
        
  

        <tbody>
           <?php
       while ( $row=$res->fetch_assoc()) {
         # code...
       ?>
       
          <tr>
            <td><?php  echo $row['COUNT']; ?></td>
            <td><?php  echo $row['department']; ?></td>
            
            
            
          
            
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