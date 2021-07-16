<?php 
include ('security.php');
include ('includes/header.php'); 
include ('includes/navbar.php');



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
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Super Admin(s)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      
                      <?php
                    include 'controller/config.php';
                      $query = "SELECT id FROM admin ORDER BY id ";
                      $query_run= mysqli_query($conn,$query);
                      $row = mysqli_num_rows($query_run);
                      echo  '<h4> Total Admins' .$row. '</h4>';

                      ?>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            

            <!-- Earnings (Monthly) Card Example -->
            

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Registered CrossNet Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      <?php
                include 'controller/config.php';
                      $query = "SELECT id FROM register ORDER BY id ";
                      $query_run= mysqli_query($conn,$query);
                      $row = mysqli_num_rows($query_run);
                      echo  '<h4> Total Users' .$row. '</h4>';

                      ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Registered Organisations </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      <?php
                    include 'controller/config.php';
                      $query = "SELECT id FROM organisation ORDER BY id ";
                      $query_run= mysqli_query($conn,$query);
                      $row = mysqli_num_rows($query_run);
                      echo  '<h4> Total Organisations' .$row. '</h4>';


                      ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Cordinated Meetings </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      <?php
                    include 'controller/config.php';
                      $query = "SELECT id FROM event ORDER BY id ";
                      $query_run= mysqli_query($conn,$query);
                      $row = mysqli_num_rows($query_run);
                      echo  '<h4> Total Cordinated Meetings'  
                      .$row.   '</h4>';

                      ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


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
  

  

  