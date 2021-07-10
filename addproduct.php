









<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add an Organisations Subscription</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<!-- Modal -->
<!-- Start of form -->

<form action ="sub2.php" method = "POST" enctype="multipart/form-data"> 
<?php 

$id = $_GET['addproduct'];
?>






<div class="modal-body">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id ?>">
<label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name">
</div>
<label>Phone Number</label>
                <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number">
</div>
<div class="form-group">
                  <label> Package Type</label>

                  <select name="category" class="form-control"> 
                    <option value="Monthly">Monthly</option>
<option value="Quartely">Quartely</option>
<option value="Annually">Annualy</option>
                  </select>
              </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name = "package" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>
</div>



