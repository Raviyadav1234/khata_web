<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = $_SESSION['email'];
}else{

    header("Location:{$base_url}");
}

     $category = @$_GET['category'];
     $product_type = @$_GET['product_type'];
     $insurance_number = @$_GET['insurance_number'];
     $sql = "SELECT * FROM policy_data  WHERE insurance_number= '{$insurance_number}' ";
     $result=mysqli_query($conn,$sql);
     // $count=mysqli_num_rows($result);
     $count = mysqli_num_rows($result);
     if($count>0){
      while($row=mysqli_fetch_assoc($result)){

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

<body id="page-top" onload="load()">

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
                    <p>Please fill in the form below to start the accounts entry:</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                    <!-- Page Heading -->
                    
                    <form method="POST" id="myform" action="policy_updatedata.php">
                    
                    <div class="form-group">
                            <label for="exampleFormControlInput1">Client Id</label>
                            <input type="text" name="client_id" class="form-control" id="exampleFormControlInput1" required value="<?php echo $row['client_id'];?>" readonly>
                        </div>

                    <div class="form-group" id="fornext">
                          <label for="exampleFormControlSelect1">Select Category</label>
                          <select class="form-control" name="category" id="category">
                            <option >Select Category</option>
                            
                            <option value="<?php echo $row['category'];?>"
                            <?php
                            if($category=="motor"){
                                echo "selected";
                                
                            }
                              ?> 
                            >motor</option>
                            <option value="<?php echo $row['category'];?>"
                            <?php
                            if($category=="nonmotor"){
                                echo "selected";
                            }
                              ?>
                            >Non Motor</option>
                         
                          </select>
                        </div>


                   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Insurance Policy Number</label>
                            <input type="text" name="insurance_number" class="form-control" id="exampleFormControlInput1" placeholder="ABIUN78514646" required value="<?php echo $row['insurance_number'];?>" readonly>
                        </div>
                   
                        <div class="form-group" id="product_type">
                            <label for="exampleFormControlSelect1">Select Product</label>
                            <select class="form-control" name="product_type" id="exampleFormControlSelect1">
                            <option value="<?php echo $row['product_type'];?>" 
                            <?php 
                            if($product_type=="private_car"){
                                echo "selected";
                              }
                            ?>
                            >Private Car</option>
                            <option value="<?php echo $row['product_type'];?>"
                            <?php 
                            if($product_type=="wheeler_2"){
                                echo "selected";
                              }
                            ?>
                            >2 Wheeler</option>
                            <option value="<?php echo $row['product_type'];?>"
                            <?php 
                            if($product_type=="commercial"){
                                echo "selected";
                              }
                            ?>
                            >Commerical</option>
                            <option value="<?php echo $row['product_type'];?>"
                            <?php 
                            if($product_type=="others"){
                                echo "selected";
                              }
                            ?>
                            >Others</option>
                            </select>
                        </div>
                        <div class="form-group" id="vehicle_number">
                            <label for="exampleFormControlInput1">Vehicle Number</label>
                            <input type="text" name="vehicle_number" class="form-control" id="exampleFormControlInput1" placeholder="HR-26-AD-8985" value="<?php echo $row['vehicle_number'];?>">
                        </div>
                        <div class="form-group" id="vehicle_model">
                            <label for="exampleFormControlInput1">Model & Make</label>
                            <input type="text" name="vehicle_model" class="form-control" id="exampleFormControlInput1" placeholder="Honda City ivtec 2016" value="<?php echo $row['vehicle_model'];?>">
                        </div>
                        
                        <label for="exampleFormControlInput1">Period of Insurance</label>
                    <div class="row">
                    <div class="form-group col-md-5">
                <input type="date" class="form-control" id="insurance_startdate" name="insurance_startdate" value="<?php echo $row['insurance_startdate'];?>">
              </div> <span> to </span>
              <div class="form-group col-md-5">
                <input type="date" class="form-control" id="insurance_enddate" name="insurance_enddate" value="<?php echo $row['insurance_enddate'];?>">
              </div>
                 </div>
                    </div>

                    <!-- Account Entry -->

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Total Amount to Collect</label>
                            <input type="text" name="total_amount" class="form-control" id="exampleFormControlInput1" placeholder="50000" required value="<?php echo $row['total_amount'];?>">
                        </div>
                        
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Installment</label>
                        <select class="form-control" name="installment" id="exampleFormControlSelect1" onchange="showDiv(this)">
                            <option value="noemi">Select EMI</option>
                            <option value="<?php echo $row['credit_debit_amount'];?>">EMI 1</option>
                            <option value="1">EMI 2</option>
                            <option value="2">EMI 3</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <div id="hidden_div" style="display:none;">
                            <label for="exampleFormControlInput1">Input Credit/Debit Amount for EMI 1</label>
                            <input type="text" value="<?php echo $row['credit_debit_amount'];?>" name="credit_debit_amount" class="form-control" id="exampleFormControlInput1" placeholder="10000">
                        </div>
                        <div id="hidden_div1" style="display:none;">
                        <p><strong>Update EMI 1 first</strong></p>
                        </div>
                        <div id="hidden_div2" style="display:none;">
                        <p><strong>Update EMI 1 first</strong></p>
                        </div>
                        </div>
                        
                            <script type="text/javascript">
                            function showDiv(select){
                            if(select.value==<?php echo $row['credit_debit_amount'];?>){
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
                            <input type="date" class="form-control" name="entry_date" id="exampleFormControlInput1" placeholder="15/06/2021" required value="<?php echo $row['entry_date'];?>">
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
                            <input type="text" class="form-control" name="payment_reference_number" id="exampleFormControlInput1" placeholder="UPI: 87954sdf858" required value="<?php echo $row['payment_reference_number'];?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="policy_update">Submit</button>
                      
                      </form>
                  <?php } } ?>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?php require_once  'includes/footer.php';?>
 
 <script>

function load(){
    var select = document.getElementById('category');
    if(select.value =='motor'){
        
      $("#secondfield").hide();
      $("#product_type").show();
      $("#vehicle_number").show();
      $("#vehicle_model").show();
    } else if(select.value=='nonmotor') {
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

    }
}
// $("#myform,#category").change(function(){
//     var value = $(this).val();
//     var product_type = document.getElementById("product_type");
//     var vehicle_number = document.getElementById("vehicle_number");
//     var vehicle_model = document.getElementById("vehicle_model");
//     if(value=='motor'){
//       $("#secondfield").hide();
//       $("#product_type").show();
//       $("#vehicle_number").show();
//       $("#vehicle_model").show();
//       // $("#fornext").after(`
//       //   <div class="form-group" id="firstfield">
//       //                     <label for="exampleFormControlSelect1">Select non motor</label>
//       //                     <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
//       //                     <option value="" selected disabled>Select Motor</option>
//       //                     <option value="car">Car</option>
//       //                     <option value="bike">Bike</option>
//       //                     <option value="truck">Truck</option>
//       //                     <option value="bus">Bus</option>
//       //                     <option value="van">Van</option>
//       //                     </select>
//       //                   </div>
//       //   `);
    

//     } else if(value=='nonmotor') {
//         $("#firstfield").hide();
//         $("#product_type").hide();
//         $("#vehicle_number").hide();
//         $("#vehicle_model").hide();
//         $("#fornext").after(`
//         <div class="form-group" id="secondfield">
//                           <label for="exampleFormControlSelect1">Select non motor</label>
//                           <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
//                           <option value="" selected disabled>Select Non-Motor</option>
//                           <option value="health">health</option>
//                           <option value="life">life</option>
//                           <option value="property">property</option>
//                           <option value="travel">travel</option>
//                           <option value="other">other</option>
//                           </select>
//                         </div>
//         `);

//                  // $("#product_type_value").val(null);
                

         

//     }
// });
</script>