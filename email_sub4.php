<?php
 include('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');





?>

<div class = "container-fluid">
  <div class = "card-header py-3">
    <h6 class = "m-0 font-weight-bold text-primary"> Email Organisations with subscriptions that are over due

    </h6>
  </div>

<div class = "card-body">
  <div class = "table responsive">
    


    <form method="POST" action="model/email_users.php">
    <div class="table-responsive">

    <?php
    include 'controller/config.php';

    date_default_timezone_set("Africa/Nairobi");
$date = date('Y-m-d');

        $query = "SELECT subscription.id,subscription.enddate,organisation.name, organisation.email, subscription.phone,subscription.status,subscription.payment_status
FROM subscription
INNER JOIN organisation ON subscription.organisationid=organisation.id AND subscription.enddate<='$date' AND subscription.payment_status='not_paid'";
        $query_run = mysqli_query($conn, $query);


        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th><input type="button"  class = "btn btn-info" value="check all" onclick="selectAll()">
<input type="button" class = "btn btn-info"value="Un check all" onclick="selectAll2()"></th>
              <th> ID </th>
              <th>Email </th>
              <th>Name </th>
              <th>Phone </th>
             

             
             
              
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
            <td>
<input class="checkbox"  type="checkbox" name="acs[]" checked="" value="<?php echo $row['email'] ?>"></td>

            <td><?php  echo "cus" .$row['id']; ?></td>
            <td><?php  echo $row['email']; ?></td>
             <td><?php  echo $row['name']; ?></td>
              <td><?php  echo $row['phone']; ?></td>
           
            
       

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
      <div class="form-group">
<label>Message</label>
<textarea required name="message" class="form-control">
</textarea>
</div>
</div>
<div class="card-footer">
  <p>The message will be sent to the emails you have checked in the above table</p>
<button type="button" class="btn btn-primary" 
data-toggle="modal" data-target="#exampleModal">Send email</button>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Send email</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="click">
  <span aria-hidden="true">&times;</span>
</button>
  </div>
  <div class="modal-body">
You are about to send an email.
  </div>
  <div class="modal-footer">

<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button  type = "submit" class="btn btn-primary">Send email</button>
  </div>
</div>
  </div>
</div>
</form>
</div>
</div>
</section>
</div>


   
    </div>
  </div>
</div>

</div>

</div>


<!-- /.container-fluid -->

<script type="text/javascript">
function selectAll(){
var items = document.getElementsByName('acs[]');
for (var i = 0; i < items.length; i++){
  if (items[i].type == 'checkbox') {
    items[i].checked = true;
  }

}
}

function selectAll2(){
var items = document.getElementsByName('acs[]');
for (var i = 0; i < items.length; i++){
  if (items[i].type == 'checkbox') {
    items[i].checked = false;
  }

}
}

</script>
<?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');
?>