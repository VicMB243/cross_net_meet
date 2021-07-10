<?php 
include('security2.php');
include ('includes/header2.php'); 
include ('includes/navbar2.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

  </div>

  <!-- Content Row -->
  <div class="row">

   <!-- Earnings (Monthly) Card Example -->


<!-- Earnings (Monthly) Card Example -->

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
<div class="card-body">
  <div class="row no-gutters align-items-center">
<div class="col mr-2">
  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Employees</div>
  <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
   <?php



if (isset($_SESSION["brands"])) {
$sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
$query_run = mysqli_query($conn, $sql)->fetch_assoc();
$name = $query_run['name'];
$sql = "select * from register where organization = '$name'";
$query_run = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query_run);
  echo  '<h4> Total Employees ' .$row. '</h4>';
}
  ?>
</div>
<div class="col-auto">
  <i class="fas fa-inbox fa-2x text-gray-300"></i>
</div>
  </div>
</div>
  </div>
</div>






<!-- Pending Requests Card Example -->

  </div>

  <!-- Content Row -->

   
</div>
<!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  
<?php 
include ('includes/scripts.php'); 
include ('includes/footer.php');


?>
  

  

  