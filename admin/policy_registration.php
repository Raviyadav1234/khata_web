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

if(isset($_POST['submit_btn'])){
      $client_id = sanatise($_POST['client_id']);
      $category = sanatise($_POST['category']);
      $category_value = sanatise(@$_POST['category_value']);
      $product_type = sanatise(@$_POST['product_type']);
      $vehicle_number = sanatise($_POST['vehicle_number']);
      $vehicle_model = sanatise($_POST['vehicle_model']);
      $insurance_number = sanatise($_POST['insurance_number']);
      $insurance_startdate = sanatise($_POST['insurance_startdate']);
      $insurance_enddate = sanatise($_POST['insurance_enddate']);
      $total_amount = sanatise($_POST['total_amount']);
      $credit_debit_amount = sanatise($_POST['credit_debit_amount']);
      $credit_debit_amount1 = sanatise(@$_POST['credit_debit_amount1']);
      $credit_debit_amount2 = sanatise(@$_POST['credit_debit_amount2']);
      $entry_date = sanatise($_POST['entry_date']);
      $payment_mode = sanatise($_POST['payment_mode']);
      $payment_reference_number = sanatise($_POST['payment_reference_number']);


$sql = "SELECT id FROM users WHERE id ='{$client_id}'";
$result = mysqli_query($conn,$sql);
$num_rows =mysqli_num_rows($result);

     $sql1 = "INSERT INTO policy_data ( client_id,category,category_value, product_type, vehicle_number, vehicle_model, insurance_number, insurance_startdate, insurance_enddate, total_amount, credit_debit_amount, credit_debit_amount1, credit_debit_amount2, entry_date, entry_date1, entry_date2, payment_mode, payment_reference_number) VALUES ('$client_id', '$category','$category_value', '$product_type', '$vehicle_number', '$vehicle_model', '$insurance_number', '$insurance_startdate', '$insurance_enddate', '$total_amount', '$credit_debit_amount', '0' , '0' , '$entry_date', '', '', '$payment_mode', '$payment_reference_number')" ;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
$result1 = mysqli_query($conn,$sql1);
if($result1){
    
     if($num_rows>0){
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Client added Successfully </div>';
     
       header("Refresh:2; url={$base_url}/admin/policy_registration.php");
     }else{
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Invalid Client Id </div>';
     
       header("Refresh:2; url={$base_url}/admin/policy_registration.php");
     }
       
      }else{
      
       $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
        header("Refresh:2; url={$base_url}/admin/policy_registration.php");
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
                    
                    <p>Please fill in the form below to start the accounts entry:</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                    <!-- Page Heading -->
                    
                    <form method="POST" id="myform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                       <div class="form-group">
                            <label for="exampleFormControlInput1">Client Id</label>
                            <input type="text" name="client_id" class="form-control" id="exampleFormControlInput1" placeholder="Enter Id" required >
                        </div>

                        <div class="form-group" id="fornext">
                          <label for="exampleFormControlSelect1">Select Category</label>
                          <select class="form-control" name="category" id="category">
                            <option value="" selected disabled>Select Category</option>
                            
                            <option value="motor">motor</option>
                            <option value="nonmotor">Non Motor</option>
                         
                          </select>
                        </div>

                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Insurance Policy Number</label>
                            <input type="text" name="insurance_number" class="form-control" id="exampleFormControlInput1" placeholder="ABIUN78514646" required>
                        </div>
                    
                        <div class="form-group" id="product_type">
                            <label for="exampleFormControlSelect1">Select Product</label>
                            <select class="form-control" name="product_type" id="product_type_value">
                              <option value="" selected disabled>Select Product</option>
                              <option value="private_car">Private Car</option>
                              <option value="wheeler_2">2 Wheeler</option>
                              <option value="commercial">Commerical</option>
                              <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="form-group" id="vehicle_number">
                            <label for="exampleFormControlInput1">Vehicle Number</label>
                            <input type="text" name="vehicle_number" id="vehicle_number_input" class="form-control" id="exampleFormControlInput1" value="" placeholder="HR-26-AD-8985">
                        </div>
                        <div class="form-group" id="vehicle_model">
                            <label for="exampleFormControlInput1">Model & Make</label>
                            <input type="text" name="vehicle_model" id="vehicle_model_input" class="form-control" id="exampleFormControlInput1" value="" placeholder="Honda City ivtec 2016">
                        </div>
                        <label for="exampleFormControlInput1">Period of Insurance</label>
                    <div class="row">
                    <div class="form-group col-md-5">
                <input type="date" class="form-control" id="insurance_startdate" name="insurance_startdate">
              </div> <span> to </span>
              <div class="form-group col-md-5">
                <input type="date" class="form-control" id="insurance_enddate" name="insurance_enddate">
              </div>
                 </div>
                    </div>

                    <!-- Account Entry -->

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Total Amount to Collect</label>
                            <input type="text" name="total_amount" class="form-control" id="exampleFormControlInput1" placeholder="50000" required>
                        </div>
                        
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Installment</label>
                        <select class="form-control" name="installment" id="exampleFormControlSelect1" onchange="showDiv(this)">
                            <option value="noemi">Select EMI</option>
                            <option value="0">EMI 1</option>
                            <option value="1">EMI 2</option>
                            <option value="2">EMI 3</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <div id="hidden_div" style="display:none;">
                            <label for="exampleFormControlInput1">Input Credit/Debit Amount for EMI 1</label>
                            <input type="text" value="0" name="credit_debit_amount" class="form-control" id="exampleFormControlInput1" placeholder="10000">
                        </div>
                        <div id="hidden_div1" style="display:none;">
                        <p><strong style="color:red;">Update EMI 1 first</strong></p>
                        </div>
                        <div id="hidden_div2" style="display:none;">
                        <p><strong style="color:red;">Update EMI 1 first</strong></p>
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
                            <input type="date" class="form-control" name="entry_date" id="exampleFormControlInput1" placeholder="15/06/2021" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Mode of Payment</label>
                            <select class="form-control" name="payment_mode" id="exampleFormControlSelect1">
                              <option value="cash" >Cash</option>
                              <option value="cheque" >Cheque</option>
                              <option value="online" >Online</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Payment Reference Number</label>
                            <input type="text" class="form-control" name="payment_reference_number" id="exampleFormControlInput1" placeholder="UPI: 87954sdf858" required>
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
 
<script>
$("#myform,#category").change(function(){
    var value = $(this).val();
    var product_type = document.getElementById("product_type");
    var vehicle_number = document.getElementById("vehicle_number");
    var vehicle_model = document.getElementById("vehicle_model");
    if(value=='motor'){
      $("#secondfield").hide();
      $("#product_type").show();
      $("#vehicle_number").show();
      $("#vehicle_model").show();
      // $("#fornext").after(`
      //   <div class="form-group" id="firstfield">
      //                     <label for="exampleFormControlSelect1">Select non motor</label>
      //                     <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
      //                     <option value="" selected disabled>Select Motor</option>
      //                     <option value="car">Car</option>
      //                     <option value="bike">Bike</option>
      //                     <option value="truck">Truck</option>
      //                     <option value="bus">Bus</option>
      //                     <option value="van">Van</option>
      //                     </select>
      //                   </div>
      //   `);
    

    } else if(value=='nonmotor') {
        $("#firstfield").hide();
        $("#product_type").hide();
        $("#vehicle_number").hide();
        $("#vehicle_model").hide();
        $("#fornext").after(`
        <div class="form-group" id="secondfield">
                          <label for="exampleFormControlSelect1">Select non motor</label>
                          <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
                          <option value="" selected disabled>Select Non-Motor</option>
                          <option value="health">health</option>
                          <option value="life">life</option>
                          <option value="property">property</option>
                          <option value="travel">travel</option>
                          <option value="other">other</option>
                          </select>
                        </div>
        `);

                 // $("#product_type_value").val(null);
                

         

    }
});
</script>