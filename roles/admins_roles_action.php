<!DOCTYPE HTML>

<html>

<head>
  <title>Edit admin</title>


      <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



    <
</script>
</head>

<body>



<?php

//import db config file

    include('../controller/config.php');



    
    


    
    $op = filter_input(INPUT_POST, 'op');
    
    
    
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $status = filter_input(INPUT_POST, 'status');
    
    $date = date("Y-m-d H:i:s");
     
     $createNewAccount = "false";
     $id = filter_input(INPUT_POST, 'id');
   
     $adminRoles = implode('|',["ACTIVATE"]);
    
    

    


        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){ 

            // Get URL parameter
            $id =  trim($_GET["id"]);


           

            //If url parameter has a valid id, get that user's values from db and set them as default in the html form
            //then edit them if necessary or it will be a new account to be created
            
            // Prepare a select statement
            $sql = "SELECT * FROM admin WHERE id = ?";
            if($stmt = mysqli_prepare($conn, $sql)){

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
        
                    if(mysqli_num_rows($result) == 1){
                    
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        // Retrieve individual field values and assign them to variables
                        $id = $row["id"];
                        $name = $row["username"];
                        $email = $row["email"];
                        $adminRoles = $row["roles"];


                    
                    } 
                    
            } else{
                header("location: error.php");
            }
        }else{
            header("location: error.php");
        }
        
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($conn);
     } 

     
    
    //to be executed on "save" operation (when the save btn is pressed)
    if ($op=="save")
    {
        

        echo "attempt to save: " ;
        
        
        //get the admin rights selected from checkboxes and assign them to the selected user/record 
        // or set default value which is the right to "ACTIVATE" new

        if(!empty($_POST['adminRoles'])){

            $adminRoles = $_POST['adminRoles'];
            // Loop to store and display values of individual checked checkbox.
            
            }else{$adminRoles = ["ACTIVATE"];}
            
            
        

           
            
                    // Prepare an update statement
                $sql = "UPDATE admin SET username=?, email=?, roles=? WHERE id=?";
               
                if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("sssi", $param_name, $param_email, $param_roles,  $param_id);
                    
                    // Set parameters
                    $param_name = $name;
                    $param_email = $email;
                    $param_roles = implode('|',$adminRoles);
                    
                    $param_id = $id;

                   
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Records updated successfully. Redirect to landing page
                       
                        ?>
                        <div class="container p-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Success!</div>
                                        <div class="panel-body">Admin registration was successful.</div>
                                    </div>
                        </div>
        
                       
                     <?php
                      
            

                        header("location: admins_roles.php");
                        
                    } else{
                        
                        echo "MySQL Error: " . mysqli_error($conn);
                    }
                     // Close statement
                    mysqli_stmt_close($stmt);
                     // Close statement
                   
     
                }
                
        


        


    }
    

?>

<div class="container p-3 col-md-6 col-sm-6 col-md-offset-3" style="padding-top: 30px;">

    <div class="panel panel-default">
    <div class="panel-heading"><h2><b>Update Admin Roles</b></h2></div>
    <div class="panel-body">

        <form method=POST action=admins_roles_action.php>

            

            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required/>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control"  name="email" value="<?php echo $email; ?>" required/>
            </div>

            <div class="form-group">
            <div ><h3><b>Admin Roles:</b></h3></div>






<?php 



//by default the corresponding checkboxes to users already assigned rights are checked

        echo'<div><label>ACTIVATE: </label></div>';
        if (strpos($adminRoles, 'ACTIVATE CUSTOMER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE CUSTOMER" checked >CUSTOMER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE CUSTOMER">CUSTOMER</div>';
             
        }
        if (strpos($adminRoles, 'ACTIVATE ADMIN') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE ADMIN" checked >ADMIN</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE ADMIN">ADMIN</div>';
             
        }
        if (strpos($adminRoles, 'ACTIVATE ORGANISATION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE ORGANISATION" checked >ORGANISATION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE ORGANISATION">ORGANISATION</div>';
             
        }

        if (strpos($adminRoles, 'ACTIVATE SUBSCRIPTION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE SUBSCRIPTION" checked >SUBSCRIPTION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE SUBSCRIPTION">SUBSCRIPTION</div>';
             
        }
        if (strpos($adminRoles, 'ACTIVATE REGISTER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE REGISTER" checked >REGISTER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ACTIVATE REGISTER">REGISTER</div>';
             
        }

        echo'<br/><br/><div><label>ADD: </label></div>';
        if (strpos($adminRoles, 'ADD ADMIN') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD ADMIN" checked >ADMIN</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD ADMIN">ADMIN</div>';
             
        }
       
        if (strpos($adminRoles, 'ADD ORGANISATION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD ORGANISATION" checked >ORGANISATION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD ORGANISATION">ORGANISATION</div>';
             
        }
        if (strpos($adminRoles, 'ADD SUBSCRIPTION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD SUBSCRIPTION" checked >SUBSCRIPTION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="ADD SUBSCRIPTION">SUBSCRIPTION</div>';
             
        }


        
        echo'<br/><br/><div><label>EDIT: </label></div>';
        if (strpos($adminRoles, 'EDIT ADMIN') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="EDIT ADMIN" checked >ADMIN</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="EDIT ADMIN">ADMIN</div>';
             
        }
       
        if (strpos($adminRoles, 'EDIT SUBSCRIBER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="EDIT SUBSCRIBER" checked >SUBSCRIBER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="EDIT SUBSCRIBER">SUBSCRIBER</div>';
             
        }



        echo'<br/><br/><div><label>SUSPEND: </label></div>';
        if (strpos($adminRoles, 'SUSPEND CUSTOMER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND CUSTOMER" checked >CUSTOMER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND CUSTOMER">CUSTOMER</div>';
             
        }
        if (strpos($adminRoles, 'SUSPEND ADMIN') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND ADMIN" checked >ADMIN</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND ADMIN">ADMIN</div>';
             
        }
        if (strpos($adminRoles, 'SUSPEND ORGANISATION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND ORGANISATION" checked >ORGANISATION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND ORGANISATION">ORGANISATION</div>';
             
        }
        if (strpos($adminRoles, 'SUSPEND SUBSCRIPTION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND SUBSCRIPTION" checked >SUBSCRIPTION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND SUBSCRIPTION">SUBSCRIPTION</div>';
             
        }
        if (strpos($adminRoles, 'SUSPEND REGISTER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND REGISTER" checked >REGISTER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="SUSPEND REGISTER">REGISTER</div>';
             
        }



        echo'<br/><br/><div><label>DELETE: </label></div>';
        
        if (strpos($adminRoles, 'DELETE ADMIN') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE ADMIN" checked >ADMIN</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE ADMIN">ADMIN</div>';
             
        }
        if (strpos($adminRoles, 'DELETE ORGANISATION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE ORGANISATION" checked >ORGANISATION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE ORGANISATION">ORGANISATION</div>';
             
        }
        if (strpos($adminRoles, 'DELETE SUBSCRIPTION') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE SUBSCRIPTION" checked >SUBSCRIPTION</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE SUBSCRIPTION">SUBSCRIPTION</div>';
             
        }
        if (strpos($adminRoles, 'DELETE REGISTER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE REGISTER" checked >REGISTER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE REGISTER">REGISTER</div>';
             
        }
        if (strpos($adminRoles, 'DELETE CONTACT') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE CONTACT" checked >CONTACT</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE CONTACT">CONTACT</div>';
             
        }
        if (strpos($adminRoles, 'DELETE EVENT') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE EVENT" checked >EVENT</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE EVENT">EVENT</div>';
             
        }
        if (strpos($adminRoles, 'DELETE SUBSCRIBER') !== false) {
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE SUBSCRIBER" checked >SUBSCRIBER</div>';
                
        }else{
            echo '<div class="checkbox-inline"><input type="checkbox" name="adminRoles[]" value="DELETE SUBSCRIBER">SUBSCRIBER</div>';
             
        }
    ?>

    <br/><br/>
            <div class="form-group">
            <a href="admins_roles.php" class="btn btn-secondary ml-2">Cancel</a>
                
            <input type="submit" class="btn btn-primary" value="Save data" />
            <input type="hidden" name="op" value="save" />
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>


            
            
            </div>

            
            
        </form>
     </div>
     </div>

</div>
  
</body>

</html>