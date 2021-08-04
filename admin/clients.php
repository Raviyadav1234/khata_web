<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
$search=$_GET['search'];

session_start();
if(!@$_SESSION['is_login']){
    exit;
}

$query="SELECT * FROM users where id = '$search'";

$result = mysqli_query($conn,$query);
if($result)
{
    $res= mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($res as $key=>$each)
    {
        $res[$key]['text']=$each['client_name']." (".$each['client_email'].")";
      
    }
}else
$res=[];
echo json_encode(['data'=>$res]);
