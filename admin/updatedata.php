<?php

require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';

session_start();
if(@$_SESSION['is_login']){
 $email = $_SESSION['email'];
}else{
 header("Location:{$base_url}");
}

 if(isset($_POST['update_btn'])){
      $client_id = sanatise($_POST['client_id']);
      $client_name = sanatise($_POST['client_name']);
      $client_email = sanatise($_POST['client_email']);
      $category = sanatise($_POST['motor']);
      $client_mobile = sanatise($_POST['client_mobile']);
      $product_type = sanatise($_POST['product_type']);
      $vehicle_number = sanatise($_POST['vehicle_number']);
      $vehicle_model = sanatise($_POST['vehicle_model']);
      $insurance_number = sanatise($_POST['insurance_number']);
      $insurance_period = sanatise($_POST['insurance_period']);
      $total_amount = sanatise($_POST['total_amount']);
      $credit_debit_amount = sanatise($_POST['credit_debit_amount']);
      $entry_date = sanatise($_POST['entry_date']);
      $payment_mode = sanatise($_POST['payment_mode']);
      $payment_reference_number = sanatise($_POST['payment_reference_number']);
      
   
    $result = mysqli_query($conn,$sql1);
    $row= mysqli_fetch_assoc($result);

      $sql = "UPDATE client SET client_id='{$client_id}', category='{$category}', client_name='{$client_name}', client_email='{$client_email}', client_mobile='{$client_mobile}', product_type='{$product_type}', vehicle_number='{$vehicle_number}', vehicle_model='{$vehicle_model}', insurance_number='{$insurance_number}', insurance_period='{$insurance_period}', total_amount='{$total_amount}', credit_debit_amount='{$credit_debit_amount}', entry_date='{$entry_date}', payment_mode='{$payment_mode}', payment_reference_number='{$payment_reference_number}' WHERE client_id='{$client_id}'";
      
      if(mysqli_query($conn,$sql) == TRUE){
      
       $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Client added Successfully </div>';
       // echo "<script> location.href='tables.php'; </script>";
        header("Location:{$base_url}/admin/tables.php");
       
      } else {
       
       $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
      }
    
   }



?>