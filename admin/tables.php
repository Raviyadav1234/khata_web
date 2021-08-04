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

<style type="text/css">
    .notfound{
  display: none;
}
</style>
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

          <!-- Sidebar -->
          <?php require_once  'includes/sidebar.php';?>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="forafter">
                        <div class="input-group">
                            <input type="text" id="txt_searchall" placeholder="Enter search text" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Gaurav Gupta</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                 <!-- Begin Page Content -->
                 <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Statement of Clients</h1>

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
                              $result = mysqli_query($conn,$sql);
                              $count=mysqli_num_rows($result);
                               if($count>0){
                                
                                ?>
                                <table class="table table-bordered text-center table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th colspan="2" class="table-dark">Category details</th>
                                            <th colspan="6"></th>
                                            <th colspan="2" class="table-dark">EMI1 details</th>
                                            <th colspan="2" class="table-dark">EMI2 details</th>
                                            <th colspan="2" class="table-dark">EMI3 details</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Policy Number</th>
                                            <th>Client Name</th>
                                            <th>Client Email</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Product Type</th>
                                            <th>Vehicle Number</th>
                                            <th>Model</th>
                                            <th>Insurance Period</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Reference Number</th>
                                            <th>EMI1 Date</th>
                                            <th>EMI1 Amount</th>
                                            <th>EMI2 Date</th>
                                            <th>EMI2 Amount</th>
                                            <th>EMI3 Date</th>
                                            <th>EMI3 Amount</th>
                                            <th>Total Amount</th>
                                            
                                            <th>Due Amount</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    



                                while($row=mysqli_fetch_assoc($result)){
                                    $due_balance = (float)$row['total_amount']-((float)$row['credit_debit_amount'] + (float)$row['credit_debit_amount1'] + (float)$row['credit_debit_amount2']);
                                    // echo $due_balance;
                                    // exit



                                    ?>
                                
                                        <tr>
                                            <td><?php echo $row['client_id'];?></td>
                                            <td><?php echo $row['insurance_number'];?></td>
                                            <td><?php echo $row['client_name'];?></td>
                                            <td><?php echo $row['client_email'];?></td>
                                            
                                            <td><?php echo $row['category'];?></td>
                                            <td><?php echo $row['category_value'];?></td>
                                            <td><?php echo $row['product_type'];?></td>
                                            <td><?php echo $row['vehicle_number'];?></td>
                                            <td><?php echo $row['vehicle_model'];?></td>
                                            <td><?php echo $row['insurance_startdate'];
                                            echo "<br><br> <b>To</b><br><br>";
                                            echo  $row['insurance_enddate'];

                                            ?>
                           
                                            </td>
                                            <td><?php echo $row['payment_mode'];?></td>
                                            <td><?php echo $row['payment_reference_number'];?></td>
                                            
                                            <td><?php echo $row['entry_date'];?></td>
                                            <td><?php echo $row['credit_debit_amount'];?></td>
                                            <td><?php echo $row['entry_date1'];?></td>
                                            <td><?php echo $row['credit_debit_amount1'];?></td>
                                            <td><?php echo $row['entry_date2'];?></td>
                                            <td><?php echo $row['credit_debit_amount2'];?></td>
                                            <td class="total_amount"><?php echo $row['total_amount'];?></td>

                                            
                                             
                                            
                                            <td><?php echo $due_balance;?></td>
                                            <td>
                <!-- <a href='edit.php?client_id=<?php echo $row['client_id'];?>' value="Edit"><i class="fas fa-pen mr-5 text-success"></i></a> -->
                <a href='delete.php?client_id=<?php echo $row['client_id'];?>' value="Delete" onclick="return confirm('Are you sure to delete?')"><i class="far fa-trash-alt ml-5 text-danger"></i></a>
                </td>
                                            
                                        </tr> 
                                    <?php } ?>
                                     <!-- Display this <tr> when no record found while search -->
                                       <tr class='notfound'>
                                         <td colspan="4">No record found</td>
                                       </tr>
                                    
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->  

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 - Karoinsure Khata</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>

<script type="text/javascript" src="js/custom.js"></script>
</body>

</html>