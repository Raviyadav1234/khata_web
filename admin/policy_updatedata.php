<?php

require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';

session_start();
if(@$_SESSION['is_login']){
 $email = $_SESSION['email'];
}else{
 header("Location:{$base_url}");
}

//this variable is for file uploadind
        $errors=array();
        $maxsize = 2097152;
        $acceptable = array(
          'application/pdf',
          'image/jpeg',
          'image/jpg',
          'image/png'
      );

 if(isset($_POST['policy_update'])){

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
      if(@$_FILES['file_name']['name']!==''){

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
        $emi2_expected_date = sanatise($_POST['emi2_expected_date']);
        $payment_mode = sanatise($_POST['payment_mode']);
        $payment_reference_number = sanatise($_POST['payment_reference_number']);

      $file_name = $_FILES["file_name"]["name"];
      $tmp_name = $_FILES["file_name"]["tmp_name"];
      $file_size = $_FILES["file_name"]["size"];
      $file_type = $_FILES["file_name"]["type"];
      $folder = "file_upload/".$file_name;
      
      

      $sql1 = "UPDATE policy_data SET category='{$category}', category_value='{$category_value}', product_type='{$product_type}', vehicle_number='{$vehicle_number}', vehicle_model='{$vehicle_model}', image='{$file_name}', insurance_startdate='{$insurance_startdate}', insurance_enddate='{$insurance_enddate}', total_amount='{$total_amount}', credit_debit_amount='{$credit_debit_amount}', entry_date='{$entry_date}', emi2_expected_date='{$emi2_expected_date}', payment_mode='{$payment_mode}', payment_reference_number='{$payment_reference_number}' WHERE insurance_number='{$insurance_number}'";
      
      if(($file_size <= $maxsize) && ($file_size!== 0)){

        if((in_array($file_type, $acceptable)) && (!empty($file_type))){
         $result1 = mysqli_query($conn,$sql1);
      
         if($result1){
             move_uploaded_file($tmp_name,$folder);
             $_SESSION['msg_start'] = time();
             $_SESSION["success"]='<div class="alert alert-success alert-dismissible fade show" role="alert"> Policy Updated Successfully
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>';
           echo "Updated Sucessfully";
            header("Refresh:0; url={$base_url}/admin/dashboard.php");
             }else{
             
              $_SESSION['msg_start'] = time();
              $_SESSION["error"]='<div class="alert alert-danger alert-dismissible fade show" role="alert"> Unable to Update
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            echo "Unable to Update";
           header("Refresh:2; url={$base_url}/admin/policy_edit.php");
               }
     
      }else{
         $error_2='Only JPEG,JPG,PDF,PNG files are accepted';
         echo '<script>alert("'.$error_2.'")</script>';
      }
     
     }else{
         $error_1='File Size should be 2MB or less than 2MB';
        echo '<script>alert("'.$error_1.'")</script>';
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
        $emi2_expected_date = sanatise($_POST['emi2_expected_date']);
        $payment_mode = sanatise($_POST['payment_mode']);
        $payment_reference_number = sanatise($_POST['payment_reference_number']);
      
      $sql2 = "UPDATE policy_data SET category='{$category}', category_value='{$category_value}', product_type='{$product_type}', vehicle_number='{$vehicle_number}', vehicle_model='{$vehicle_model}',  insurance_startdate='{$insurance_startdate}', insurance_enddate='{$insurance_enddate}', total_amount='{$total_amount}', credit_debit_amount='{$credit_debit_amount}', entry_date='{$entry_date}', emi2_expected_date='{$emi2_expected_date}', payment_mode='{$payment_mode}', payment_reference_number='{$payment_reference_number}' WHERE insurance_number='{$insurance_number}'";
      $result2 = mysqli_query($conn,$sql2);

      if($result2){
        $_SESSION['msg_start'] = time();
        $_SESSION["success"]='<div class="alert alert-success alert-dismissible fade show" role="alert"> Policy Updated Successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      echo "Updated Sucessfully";
       header("Refresh:0; url={$base_url}/admin/dashboard.php");
       
      } else {
       
        
        $_SESSION['msg_start'] = time();
        $_SESSION["error"]='<div class="alert alert-danger alert-dismissible fade show" role="alert"> Unable to Update
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      echo "Unable to Update";
        header("Refresh:2; url={$base_url}/admin/policy_edit.php");
        
      }


      }

      
 
   }



?>