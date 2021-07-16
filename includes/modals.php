<div class="modal fade" id="suc">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Successful!!</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<p>Your email has been sent succesfully</p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<?php 
if (isset($_GET['suc'])) {
	# code...
?>
<script type="text/javascript">
	$('#suc').modal('show');
</script>
<?php
}
?>