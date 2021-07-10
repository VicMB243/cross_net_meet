<?php
 include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>


<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Shows how many meetings have been held per organisation and  per department
      <form action="go10.php" method="POST">

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
                  <input type="submit" name="export" class="btn btn-primary btn-sm" value=" Generate Report" />
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
           
         
        <th> Number of Meetings Per Department </th>
        <th> organization</th>
        <th> Department </th>
               
              
             
           
                
                
          </tr>
        </thead>


         <?php
      
       
if (isset($_SESSION["brands"])) {
  $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run['name'];

 
$sql = "SELECT COUNT(event.id) as COUNT,event.id, register.email,register.department, register.organization, register.department FROM event JOIN register ON register.id=event.uid WHERE register.organization = '$name' GROUP BY register.department ";
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
            
              <td><?php  echo $row['organization']; ?></td>
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