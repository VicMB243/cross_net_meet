<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>
<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Number of Meeting Being Carried out by an organization
     <hr> <h6 class = "m-0 font-weight-bold text-primary">Organisation Data Reports</h6>

     <form action="go4.php" method="POST">
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

       $query = "SELECT COUNT(event.id) as COUNT,event.id, register.email,register.organization, register.department FROM event JOIN register ON register.id=event.uid WHERE register.organization !='' GROUP BY register.organization";
       $query_run = mysqli_query($conn, $query);


       
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th>Organization Name </th>
                                
                                
                                 
                                 
                                 <th>Number of Meetings</th>
                                
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
           <td><?php echo $row['organization']; ?></td>
            
             
             
                                        <td><?php echo $row['COUNT']?></td>
       
            <td>
              
            
            

                
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