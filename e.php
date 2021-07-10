<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add a Subsriber </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">


      <form action="sub2.php" method="POST">

        
<div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email3" placeholder="Enter Email">
                <small class="error_email3" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number">
            </div>
<div class="form-group">
<label>Package Type</label>
<select class="form-control" name="category">
<option></option>

<optgroup label="Package Options ">
<option value="Monthly">Monthly</option>
<option value="Quartely">Quartely</option>
<option value="Annually">Annualy</option>
</optgroup>
</optgroup>
</select>
</div>
           </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="package" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class ="container-fluid">
  <!--Datatales Example -->
  <div class = "card shadow mb-4">
  <div class= "card-heaader py-3">
    <h6 class "m-0 font-weight-bold text-primary">Number of Meeting Being Carried out by an organization </h6>


 <h6 class "m-0 font-weight-bold text-primary">Organisation Data</h6>
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

       $query = "SELECT COUNT(event.id) as COUNT,event.id, register.username,register.email,event.uid FROM event JOIN register ON register.id=event.uid GROUP BY uid";
                        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th>Username</th>
                                <th>Organization Email</th>
                                <th>Number of Meetings</th>
                                <th>Action</th>
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
           <td><?php echo $row['username']; ?></td>
            
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