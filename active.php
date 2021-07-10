<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>
<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Active Users
    
    

    </h6>
  </div>
<div class = "card-body">
  <div class = "table responsive">
    

    <div class="table-responsive">

    <?php
    include 'controller/config.php';

        $query = "SELECT * FROM register where active = '1' ";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th> Id </th>
              <th> Username </th>
              <th> Email</th>
             
               
              
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