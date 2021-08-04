<?php
     require __DIR__ .'/config/dbconnection.php';
    require __DIR__.'/functions/function.php';
    session_start();
  if(@$_SESSION['is_login']){
  $email = $_SESSION['email'];
  }else{
 // echo "<script> location.href='../index.php'; </script>";
    header("Location:{$base_url}");
 }

     $client_id = @$_GET['id'];
     $insurance_number = @$_GET['insurance_number'];

     $sql = "DELETE  FROM users WHERE id = '{$client_id}' ; ";
     $sql .= "DELETE * FROM policy_data WHERE client_id = '{$client_id}'";
     $result=mysqli_multi_query($conn,$sql);
      
    if($result){
      
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Policy Updated Successfully </div>';
  
      header("Refresh:0; url={$base_url}/admin/dashboard.php");
    }
    
  
?>