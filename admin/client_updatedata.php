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

  $id = @$_GET['id'];
//Start client update code here
if(isset($_POST['update_client'])){
    $id = sanatise(@$_POST['id']);
    $client_name = sanatise(@$_POST['client_name']);
    $client_email = sanatise(@$_POST['client_email']);
    $client_mobile = sanatise(@$_POST['client_mobile']);
if($client_name=="" || $client_email=="" || $client_mobile==""){
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    $error_1='Fill All Fields';
    echo '<script>alert("'.$error_1.'")</script>';
    //echo " Fill All Fields";
    header("Refresh:0; url={$base_url}/admin/client_edit.php?id={$id}");
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

    $_SESSION['msg_start'] = time();
    $_SESSION["success"]='<div class="alert alert-success alert-dismissible fade show" role="alert"> Client Updated Successfully 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  echo "Updated Sucessfully";
    header("Refresh:0; url={$base_url}/admin/dashboard.php");
  }else{

    $_SESSION['msg_start'] = time();
        $_SESSION["error"]='<div class="alert alert-danger alert-dismissible fade show" role="alert">Unable to Update
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      echo "Unable to Update";
      header("Refresh:0; url={$base_url}/admin/client_edit.php?id={$id}");
  }
}

 }//End client update code here