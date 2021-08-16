<?php

require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';

session_start();
if(@$_SESSION['is_login']){
 $email = $_SESSION['email'];
}else{
 header("Location:{$base_url}");
}


 if(isset($_POST['policy_update'])){

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
      if(@$_POST['file_new_name']!==''){
        $category = sanatise(@$_POST['category']);
        $category_value = sanatise(@$_POST['category_value']);
        $product_type = sanatise($_POST['product_type']);
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

      $file_new_name = $_FILES["file_new_name"]["name"];
      $tmp_new_name = $_FILES["file_new_name"]["tmp_name"];
      $folder_new = "file_upload/".$file_new_name;
      $upload_new = move_uploaded_file($tmp_new_name,$folder_new);
      

      $sql1 = "UPDATE policy_data SET category='{$category}', category_value='{$category_value}', product_type='{$product_type}', vehicle_number='{$vehicle_number}', vehicle_model='{$vehicle_model}', image='{$file_new_name}', insurance_startdate='{$insurance_startdate}', insurance_enddate='{$insurance_enddate}', total_amount='{$total_amount}', credit_debit_amount='{$credit_debit_amount}', entry_date='{$entry_date}', payment_mode='{$payment_mode}', payment_reference_number='{$payment_reference_number}' WHERE insurance_number='{$insurance_number}'";
      $result1 = mysqli_query($conn,$sql1);

      if($result1){
        move_uploaded_file($tmp_new_name,$folder_new);
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Policy Updated Successfully </div>';
  
       header("Refresh:0; url={$base_url}/admin/dashboard.php");
       
      } else {
       
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update</div>';
        header("Refresh:2; url={$base_url}/admin/policy_edit.php");
      }


      } else{

        $category = sanatise(@$_POST['category']);
        $category_value = sanatise(@$_POST['category_value']);
        $product_type = sanatise($_POST['product_type']);
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
        $file_old_name = $_POST['file_old_name'];
        // $file_old_name = $_FILES["file_old_name"]["name"];
        // $tmp_old_name = $_FILES["file_old_name"]["tmp_name"];
        // $folder_old = "file_upload/".$file_old_name;
        // $upload_old = move_uploaded_file($tmp_old_name,$folder_old);
      
      $sql2 = "UPDATE policy_data SET category='{$category}', category_value='{$category_value}', product_type='{$product_type}', vehicle_number='{$vehicle_number}', vehicle_model='{$vehicle_model}', image='{$file_old_name}', insurance_startdate='{$insurance_startdate}', insurance_enddate='{$insurance_enddate}', total_amount='{$total_amount}', credit_debit_amount='{$credit_debit_amount}', entry_date='{$entry_date}', payment_mode='{$payment_mode}', payment_reference_number='{$payment_reference_number}' WHERE insurance_number='{$insurance_number}'";
      $result2 = mysqli_query($conn,$sql2);

 
      if($result2){
        //move_uploaded_file($tmp_old_name,$folder_old);
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Policy Updated Successfully </div>';
  
       header("Refresh:0; url={$base_url}/admin/dashboard.php");
       
      } else {
       
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update</div>';
        header("Refresh:2; url={$base_url}/admin/policy_edit.php");
      }


      }

      
      
   

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
//$result = mysqli_query($conn,$sql);
      // if($result1 or $result2 ){
      //   move_uploaded_file($tmp_new_name,$folder_new) || move_uploaded_file($tmp_old_name,$folder_old);
      //   $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Policy Updated Successfully </div>';
  
      //  header("Refresh:0; url={$base_url}/admin/dashboard.php");
       
      // } else {
       
      //   $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update</div>';
      //   header("Refresh:2; url={$base_url}/admin/policy_edit.php");
      // }
    
   }



?>