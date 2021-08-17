<?php
// require __DIR__ .'/config/dbconnection.php';
include("config/dbconnection.php");
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
 // echo "<script> location.href='../index.php'; </script>";
    header("Location:{$base_url}");
}

if(isset($_POST['submit_btn'])){
      $client_id = sanatise($_POST['client_id']);
      $insurance_number = sanatise($_POST['insurance_number']);
      $credit_debit_amount2 = sanatise($_POST['credit_debit_amount2']);
      $entry_date2 = sanatise($_POST['entry_date2']);
      $payment_mode = sanatise($_POST['payment_mode']);

    $sql = "SELECT * FROM policy_data WHERE insurance_number='{$insurance_number}' AND client_id='{$client_id}'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if(@$row['client_id']==$client_id && @$row['insurance_number']==$insurance_number){

    //sql for check if EMI2 is already fill
    $sql1 = "SELECT * FROM policy_data WHERE insurance_number='{$insurance_number}'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $value = @$row1['credit_debit_amount1'];

   $sql2 = "UPDATE policy_data SET
     insurance_number ='{$insurance_number}', 
     credit_debit_amount2='{$credit_debit_amount2}',
     entry_date2='{$entry_date2}',
     payment_mode ='{$payment_mode}'
     WHERE insurance_number='{$insurance_number}'
     " ;

   $result2 = mysqli_query($conn,$sql2);
   $affected_row = mysqli_affected_rows($conn);

   
  if($affected_row>0){
 if($value>0){
   $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> EMI3 Updated Successfully </div>';
 
   header("Refresh:2; url={$base_url}/admin/dashboard.php");
 }else{
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Update EMI2 first</div>';
    header("Refresh:2; url={$base_url}/admin/emi3_update.php");
 }

 
   } else {
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update EMI3 </div>';
    header("Refresh:2; url={$base_url}/admin/emi3_update.php");
   }


    }else{
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Invalid Client Id or Insurance Number</div>';
        header("Refresh:2; url={$base_url}/admin/emi3_update.php");
    }



   
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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
                    <?php if(isset($msg)){echo $msg;}?>
                    <h2>Update EMI3 Here</h2>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                    <!-- Page Heading -->
                    
                    <form method="POST" id="myform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">


                    <div class="form-group">
                            <label for="exampleFormControlInput1">Client Id</label>
                            <select type="text" name="client_id" class="form-control" id="clientid" placeholder="Enter Id" required ></select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Insurance Policy Number</label>
                            <input type="text" name="insurance_number" class="form-control" id="exampleFormControlInput1" placeholder="ABIUN78514646" required>
                        </div>
                        

                    <!-- Account Entry -->

        
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Instalment</label>
                        <select class="form-control" name="installment" id="exampleFormControlSelect1" onchange="showDiv(this)">
                            <option value="noemi">Select EMI</option>
                            <option value="0">EMI 1</option>
                            <option value="1">EMI 2</option>
                            <option value="2">EMI 3</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <div id="hidden_div" style="display:none;">
                            <p><strong style="color:red;">EMI 1 is already up to date</strong></p>
                        </div>
                        <div id="hidden_div1" style="display:none;">
                        <p><strong style="color:red;">EMI 2 is already up to date</strong></p>
                        </div>
                        <div id="hidden_div2" style="display:none;">
                        <label for="exampleFormControlInput1">Input Credit/Debit Amount for EMI 3</label>
                            <input type="text" value="0" name="credit_debit_amount2" class="form-control" id="exampleFormControlInput1" placeholder="20000">
                        </div>
</div>
                        
                            <script type="text/javascript">
                            function showDiv(select){
                            if(select.value==0){
                                document.getElementById('hidden_div').style.display = "block";
                                document.getElementById('hidden_div1').style.display = "none";
                                document.getElementById('hidden_div2').style.display = "none";
                            } else if (select.value==1)
                            {
                                document.getElementById('hidden_div1').style.display = "block";
                                document.getElementById('hidden_div').style.display = "none";
                                document.getElementById('hidden_div2').style.display = "none";
                            }
                                else if (select.value==2)
                            {
                                document.getElementById('hidden_div2').style.display = "block";
                                document.getElementById('hidden_div1').style.display = "none";
                                document.getElementById('hidden_div').style.display = "none";
                            }
                            else{
                                document.getElementById('hidden_div').style.display = "none";
                                document.getElementById('hidden_div1').style.display = "none";
                                document.getElementById('hidden_div2').style.display = "none";
                            }
                            }
                            </script>

                        <!-- <div class="form-group">
                            <label for="exampleFormControlInput1">Input Credit/Debit Amount</label>
                            <input type="text" name="credit_debit_amount" class="form-control" id="exampleFormControlInput1" placeholder="60000" required>
                        </div> -->

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Enter Date</label>
                            <input type="date" class="form-control" name="entry_date2" id="exampleFormControlInput1" placeholder="15/06/2021" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Mode of Payment</label>
                            <select class="form-control" name="payment_mode" id="exampleFormControlSelect1">
                              <option value="cash" >Cash</option>
                              <option value="cheque" >Cheque</option>
                              <option value="online" >Online</option>
                            </select>
                        </div>
                            
                        <button type="submit" class="btn btn-primary mb-2" name="submit_btn">Submit</button>
                      
                      </form>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?php require_once  'includes/footer.php';?>


 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>


$("#clientid").select2({
     placeholder: "Enter Client Id",
                        allowClear: true,
                        ajax: {
                            url: "clients_autofill.php",
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                }

                                return query;
                            },
                            processResults: function(data) {
                                var mydata = $.map(data.data, function (obj) {
  obj.text = obj.text || obj.name;

  return obj;
});
                                return {
                                    results: mydata
                                };
                            }
                        },
                        minimumInputLength: 1,

                    })
    </script>


 