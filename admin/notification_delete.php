<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
    header("Location:{$base_url}");
}

$sql = "TRUNCATE table policy_notification;";
$sql .= "TRUNCATE table emi2_notification;";
$sql .= "TRUNCATE table emi3_notification";
$result = mysqli_multi_query($conn,$sql);
if($result){
    header("Location:{$base_url}/admin/dashboard.php");  
}