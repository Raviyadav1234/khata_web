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

                      <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Policy Details of Clients</h1>
                 
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
                $id = $_GET['client_id'];
                $sql1 = "SELECT * FROM policy_data WHERE client_id = '{$id}' ";
                              $result1 = mysqli_query($conn,$sql1);
                              $count=mysqli_num_rows($result1);
                               if($count>0){
                                
                                ?>
                                <table class="table table-bordered text-center table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CLient_Id</th>
                                            <th>Policy Number</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Product Type</th>
                                            <th>Vehicle Number</th>
                                            <th>Model</th>
                                            <th>Insurance Start On</th>
                                            <th>Insurance Expire On</th>
                                            <th>Expiry Status</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Reference Number</th>
                                            <th>EMI1 Fill Date</th>
                                            <th>EMI2 Reminder Date</th>
                                            <th>EMI1 Amount</th>
                                            <th>EMI2 Fill Date</th>
                                            <th>EMI3 Reminder Date</th>
                                            <th>EMI2 Amount</th>
                                            <th>EMI3 Fill Date</th>
                                            <th>EMI3 Amount</th>
                                            <th>Total Amount</th>
                                            <th>Due Amount</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    

                              
                              $due = 0;
                                while($row=mysqli_fetch_assoc($result1)){
                                     $due_balance = (float)$row['total_amount']-((float)$row['credit_debit_amount'] + (float)$row['credit_debit_amount1'] + (float)$row['credit_debit_amount2']);
                                    // echo $due_balance;
                                    // exit

                                    ?>
                                
                                        <tr>
                                            <td><?php echo $row['client_id'];?></td>
                                            <td><?php echo $row['insurance_number'];?></td>
                                            <td>
                                              <?php 
                                              if(pathinfo($row['image'], PATHINFO_EXTENSION)=='pdf'){?>
                                                <img src="file_upload/<?php echo $row['image'];?>" class="d-none"/>
                                                <img src="img/pdf-icon.png" class="img-thumbnail img-fluid" height="50px" width="50px"/>

                                            <?php }else{?>
                                             <img src="file_upload/<?php echo $row['image'];?>" class="img-thumbnail" style="height: 50px;width:100px;" />
                                          <?php  }
                                              ?>
                                            
                                              <?php echo $row['image'];?>
                                              <br><a type="button" href="file_upload/<?php echo $row['image'];?>" target="_blank" class="btn btn-primary">Preview</a>
                                              
                                              <p>Or</p>
                                              <a type="button" href="pdf_download.php?file=file_upload/<?php echo $row['image'];?>" target="_ravi" class="btn btn-primary">Download</a>
                                              
                                          </td>
                                   
                                            <td><?php echo $row['category'];?></td>
                                            <td><?php echo $row['category_value'];?></td>
                                            <td><?php echo $row['product_type'];?></td>
                                            <td><?php echo $row['vehicle_number'];?></td>
                                            <td><?php echo $row['vehicle_model'];?></td>
                                           <td><?php echo $row['insurance_startdate'];?>
                                            </td>
                                            <td><?php echo $row['insurance_enddate'];?>
                                            </td>
                                            <td>
                                              <?php
                                            $today_date = date('Y/m/d');
                                            $td = strtotime($today_date);
                                  $exp_date=strtotime($row['insurance_enddate']);
                                              if($td>$exp_date){
                                             $diff_days = $td-$exp_date;
                                $remain_date = abs(floor($diff_days/(60*60*24)));
                                echo "<b class='text-danger'>Insurance has expired before <span style='color:black;'>{$remain_date}</span> days ago</b>";
                                              }else{
                                               $diff_days = $td-$exp_date;
                                $remain_date = abs(floor($diff_days/(60*60*24)));
                                                echo "<b class='text-success'>Insurance will expired in <span style='color:black;'>{$remain_date}</span> days</b>";
                                                
                                              }
                                              ?>
                                            </td>
                                            <td><?php echo $row['payment_mode'];?></td>
                                            <td><?php echo $row['payment_reference_number'];?></td>
                                            
                                            <td><?php echo $row['entry_date'];?></td>
                                            <td><?php echo $row['emi2_expected_date'];?></td>
                                            <td><?php 
                                             $due+= $row['credit_debit_amount'];
                                            echo $row['credit_debit_amount'];?></td>
                                            <td><?php echo $row['entry_date1'];?></td>
                                            <td><?php echo $row['emi3_expected_date'];?></td>
                                            <td><?php
                                             $due+= $row['credit_debit_amount1'];
                                             echo $row['credit_debit_amount1'];?></td>
                                            <td><?php echo $row['entry_date2'];?></td>
                                            <td><?php 
                                            $due+= $row['credit_debit_amount2'];
                                            echo $row['credit_debit_amount2'];?></td>
                                            <td class="total_amount"><?php echo $row['total_amount'];?></td>

                                            <td><?php echo $due_balance;?></td>
                                       
                    
                 <td>                          
                <a href="policy_edit.php?insurance_number=<?php echo $row['insurance_number']?>&category=<?php echo $row['category']?>&product_type=<?php echo $row['product_type']?>&category_value=<?php echo $row['category_value'];?>" value="Edit"><i class="fas fa-pen mr-5 text-success"></i></a>
                <a href='policy_delete.php?insurance_number=<?php echo $row['insurance_number'];?>' value="Delete" onclick="return confirm('Are you sure to delete?')" id="del_policy"><i class="far fa-trash-alt ml-5 text-danger"></i></a>
                </td>
                                            
                                        </tr> 
                                    <?php } ?>
                                    
                                    </tbody>
                                
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

<?php 
$sql2 = "SELECT SUM(total_amount) FROM policy_data WHERE client_id = '{$id}' ";
$sum_total_amount = mysqli_query($conn,$sql2);
$result2 =mysqli_fetch_row($sum_total_amount);

?>
<!-- for grand total -->
<div class="row">
  <div class="col-sm-6">
    <div class="card bg-warning">
      <div class="card-body">
        <h5 class="card-title"><b>Total Amount :</b> </h5>
        <p class="card-text">
          <?php 
          //echo ($result2[0]);
         echo isset($result2[0])?$result2[0]:0;
          ?>

      </p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card bg-warning">
      <div class="card-body">
        <h5 class="card-title"><b>Total Due Amount :</b> </h5>
        <p class="card-text">
          <?php
          // echo ($result2[0]-$due);
          $d_am = $result2[0]-@$due;
          echo isset($d_am)?$d_am:0;
          ?>
        </p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
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


