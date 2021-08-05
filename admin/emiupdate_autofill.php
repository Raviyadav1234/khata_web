<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
$search=$_GET['search'];

session_start();
if(!@$_SESSION['is_login']){
    exit;
}

$query="SELECT * FROM users where id = '$search'";

// $query = "SELECT users.client_name, users.client_email,users.client_mobile,
//                               policy_data.insurance_number,
//                               policy_data.client_id,
//                               policy_data.category,
//                               policy_data.category_value,
//                               policy_data.product_type,
//                               policy_data.vehicle_number,
//                               policy_data.vehicle_model,
//                               policy_data.insurance_startdate,
//                               policy_data.insurance_enddate,
//                               policy_data.total_amount,
//                               policy_data.credit_debit_amount,
//                               policy_data.credit_debit_amount1,
//                               policy_data.credit_debit_amount2,
//                               policy_data.entry_date,
//                               policy_data.entry_date1,
//                               policy_data.entry_date2,
//                               policy_data.payment_mode,
//                               policy_data.payment_reference_number
//                 FROM users JOIN policy_data ON users.id=policy_data.client_id where insurance_number = '$search'";


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
