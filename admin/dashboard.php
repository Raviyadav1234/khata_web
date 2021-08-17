<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
 // echo "<script> location.href='../index.php'; </script>";
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

                  <!-- success and error message show-->
                  <div class="row">
                  <div class="col-lg-12">
                  <?php 
                if(isset($_SESSION['success'])){
                    if (time() - $_SESSION['msg_start'] < 30){ 
                        echo $_SESSION['success']; 
                    }else{
                       unset($_SESSION['success']);
                      }
                }

                if(isset($_SESSION['error'])){
                    if (time() - $_SESSION['msg_start'] < 30){ 
                        echo $_SESSION['error']; 
                    }else{
                       unset($_SESSION['error']);
                      }
                }
                  ?>
                  </div>
                  </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Basic Details of Clients</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Credit/Debit Statement</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                            $sql = "SELECT users.client_name, users.client_email,users.client_mobile,
                              policy_data.insurance_number,
                              policy_data.client_id,
                              policy_data.category,
                              policy_data.category_value,
                              policy_data.product_type,
                              policy_data.vehicle_number,
                              policy_data.vehicle_model,
                              policy_data.insurance_startdate,
                              policy_data.insurance_enddate,
                              policy_data.total_amount,
                              policy_data.credit_debit_amount,
                              policy_data.credit_debit_amount1,
                              policy_data.credit_debit_amount2,
                              policy_data.entry_date,
                              policy_data.entry_date1,
                              policy_data.entry_date2,
                              policy_data.payment_mode,
                              policy_data.payment_reference_number
                FROM users JOIN policy_data ON users.id=policy_data.client_id ";
                $sql1 = "SELECT * FROM users";
                              $result = mysqli_query($conn,$sql1);
                              $count=mysqli_num_rows($result);
                               if($count>0){
                                
                                ?>
                                <table class="table table-bordered text-center table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CLient_Id</th>
                                            <th>Client Name</th>
                                            <th>Client Email</th>
                                            <th>Client Mobile</th>
                                            <th>Policy Details</th>
                                            <th>Export Data</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    



                                while($row=mysqli_fetch_assoc($result)){
                                    

                                    ?>
                                
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            
                                            <td><?php echo $row['client_name'];?></td>
                                            <td><?php echo $row['client_email'];?></td>
                                            <td><?php echo $row['client_mobile'];?></td>
                                            <td>                          
                
                <a href='policy_view.php?client_id=<?php echo $row['id'];?>' class="text-decoration-none"><span class="text-success">View</span>&nbsp;<i class="fa fa-eye text-success" aria-hidden="true"></i></a>
                </td>
                <td>                          
                
                <a href='export_details.php?client_id=<?php echo $row['id'];?>' class="btn btn-primary">Export</a>
                </td>

                 <td>                          
                <a href='client_edit.php?id=<?php echo $row['id'];?>' value="Edit"><i class="fas fa-pen mr-5 text-success"></i></a>
                <a href='client_delete.php?id=<?php echo $row['id'];?>' value="Delete" onclick="return confirm('Are you sure to delete?')"><i class="far fa-trash-alt ml-5 text-danger"></i></a>
                </td>
                                            
                                        </tr> 
                                    <?php } ?>
                                    
                                    </tbody>
                                
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


 <?php require_once  'includes/footer.php';?>
 <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>

