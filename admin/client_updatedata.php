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

//Start client update code here
if(isset($_POST['update_client'])){
    $id = sanatise(@$_POST['id']);
    $client_name = sanatise(@$_POST['client_name']);
    $client_email = sanatise(@$_POST['client_email']);
    $client_mobile = sanatise(@$_POST['client_mobile']);
if($client_name=="" || $client_email=="" || $client_mobile==""){
  $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    header("Refresh:2; url={$base_url}/admin/client_edit.php");
}else{
   $sql = "UPDATE users SET 
        users.client_name='{$client_name}',
        users.client_email='{$client_email}',
        users.client_mobile='{$client_mobile}' WHERE id = '{$id}' ";
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit;
 $result = mysqli_query($conn,$sql);

  
  if($result){
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Client Updated Successfully </div>';
  
    header("Refresh:0; url={$base_url}/admin/dashboard.php");
  }else{
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update</div>';
     header("Refresh:2; url={$base_url}/admin/client_edit.php");
  }
}

 }//End client update code here