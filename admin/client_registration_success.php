<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
 
    header("Location:{$base_url}");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Karoinsure Khata Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <?php require_once  'includes/sidebar.php';?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once 'includes/header.php';?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if(isset($msg)){
                        print($msg);
                    }
                    ?>
                    
                   
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                    <!-- Page Heading -->
                    
                    <?php 
                $last_insert_id = mysqli_insert_id($conn);
                $sql = "SELECT * FROM users WHERE id = '{$last_insert_id}' ";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) == 1){
                 $row = mysqli_fetch_assoc($result);
                 echo "<div class='ml-5 mt-5'>
                 <table class='table'>
                  <tbody>
                   <tr>
                     <th>Client Id</th>
                     <td>".$row['id']."</td>
                   </tr>
                   <tr>
                     <th>Name</th>
                     <td>".$row['client_name']."</td>
                   </tr>
                   <tr>
                   <th>Email ID</th>
                   <td>".$row['client_email']."</td>
                  </tr>
                   <tr>
                    <th>Client Mobile</th>
                    <td>".$row['client_mobie']."</td>
                   </tr>

                   <tr>
                    <td><form class='d-print-none'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form></td>
                  </tr>
                  </tbody>
                 </table> </div>
                 ";


                } else {
                  echo "Failed";
                }

                    ?>

        
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?php require_once  'includes/footer.php';?>




 