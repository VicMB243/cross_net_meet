<?php
 include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>


<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Oraganisation Information 
    
 
    

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
              <th> Start Date</th>
              <th> End Date</th>
                <th> status </th>
                <th> Payment Status </th>
              
             
           
                
                
          </tr>
        </thead>


         <?php
      include 'controller/config.php';

       
if (isset($_SESSION["brands"])) {
  $date = date('Y-m-d');
  $id = $_SESSION["brands"];
$sql = "select * from subscription where organisationid = '$id' AND enddate <='$date' AND payment_status = 'not_paid' ";
$query_run = mysqli_query($conn, $sql);

?>
        
  

        <tbody>
          <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
               ?>
       
          <tr>
            <td><?php  echo $row['phone']; ?></td>
            <td><?php  echo $row['package']; ?></td>
            <td><?php  echo $row['startdate']; ?></td>
            <td><?php  echo $row['enddate']; ?></td>
            <td><?php  echo $row['status']; ?></td>
            <td><?php  echo $row['payment_status']; ?></td>
           
            
             
          
            
          </tr>
          
        </tbody>
        <?php
            } 
        }
        else {
            echo "No Record Found";
        }
      }
        ?>

      </table>
</div>
</div>
</div>



     </div>   
 <?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>