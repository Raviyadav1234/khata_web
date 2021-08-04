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

     $client_id = $_GET['client_id'];

     $sql = "DELETE FROM client WHERE client_id= '{$client_id}'";
     $result=mysqli_query($conn,$sql) or die("query unsuccessfull");
      
     // echo "<script> location.href='tables.php'; </script>";
     header("Location:{$base_url}/admin/tables.php");
    
    mysqli_close($conn);

?>