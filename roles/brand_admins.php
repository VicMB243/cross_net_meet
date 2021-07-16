<?php

include('../controller/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div style="padding-top: 30px; padding-right: 30px">

    <div class="wrapper">
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Admins Details</h2>
                        <a href="brand_admins_roles_action.php" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Admin</a>
                        
                    </div>


                    <?php
                    
                   
                    $sql = "SELECT * FROM brand_admins ORDER BY id DESC";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){


                           




                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>email</th>";
                                        echo "<th>organisation</th>";
                                        echo "<th>status</th>";
                                        echo "<th>date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $organization_id = $row['brand_id'];

                                    $sql = "SELECT * FROM organisation WHERE id = '$organization_id'";
                                    $query_run = mysqli_query($conn, $sql)->fetch_assoc();
                                    $organizationname = $query_run['name'];

                                    
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $organizationname . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['datecreated'] . "</td>";

                                        echo "<td>";
                                        //pass the selected user'id to the add/edit or the delete page depending on the clicked link
                                        //that is where current admin's rights are checked before any operation on the selected user(record)
                                            echo '<a href="brand_admins_roles_action.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            
                                            echo '<a href="delete_brand_admin.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>