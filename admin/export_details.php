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

$sql = "SELECT users.client_name, users.client_email,users.client_mobile,
                              policy_data.insurance_number,
                              policy_data.client_id,
                              policy_data.category,
                              policy_data.category_value,
                              policy_data.product_type,
                              policy_data.vehicle_number,
                              policy_data.vehicle_model,
                              policy_data.insurance_startdate,
                              policy_data.insurance_enddate,
                              policy_data.total_amount,
                              policy_data.credit_debit_amount,
                              policy_data.credit_debit_amount1,
                              policy_data.credit_debit_amount2,
                              policy_data.entry_date,
                              policy_data.entry_date1,
                              policy_data.entry_date2,
                              policy_data.payment_mode,
                              policy_data.payment_reference_number
                FROM users JOIN policy_data ON users.id=policy_data.client_id ";


$id = $_GET['client_id'];
$sql1 = "SELECT * FROM policy_data WHERE client_id = '{$id}' ";
//$sql1 = "SELECT * FROM policy_data ";
$result=mysqli_query($conn,$sql1);
 
$html='<table><thead><tr>
                                            <th>CLient_Id</th>
                                            <th>Policy Number</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Product Type</th>
                                            <th>Vehicle Number</th>
                                            <th>Model</th>
                                            <th>Insurance Start On</th>
                                            <th>Insurance Expire On</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Reference Number</th>
                                            <th>EMI1 Fill Date</th>
                                            <th>EMI2 Reminder Date</th>
                                            <th>EMI1 Amount</th>
                                            <th>EMI2 Fill Date</th>
                                            <th>EMI3 Reminder Date</th>
                                            <th>EMI2 Amount</th>
                                            <th>EMI3 Fill Date</th>
                                            <th>EMI3 Amount</th>
                                            <th>Total Amount</th>
                                            <th>Due Amount</th>
                                            
</tr></thead>';

$due = 0;
while($row=mysqli_fetch_assoc($result)){
    $due_balance = (float)$row['total_amount']-((float)$row['credit_debit_amount'] + (float)$row['credit_debit_amount1'] + (float)$row['credit_debit_amount2']);


	$html.='<tbody><tr>
    <td>'.$row['client_id'].'</td>
    <td>'.$row['insurance_number'].'</td>
    <td>'.$row['category'].'</td>
    <td>'.$row['category_value'].'</td>
    <td>'.$row['product_type'].'</td>
    <td>'.$row['vehicle_number'].'</td>
    <td>'.$row['vehicle_model'].'</td>
    <td>'.$row['insurance_startdate'].'</td>
    <td>'.$row['insurance_enddate'].'</td>
    

    <td>'.$row['payment_mode'].'</td>
    <td>'.$row['payment_reference_number'].'</td>
    <td>'.$row['entry_date'].'</td>
    <td>'.$row['emi2_expected_date'].'</td>
    
    <td>'.
    $row['credit_debit_amount']
    .'</td>
    <td>'.$row['entry_date1'].'</td>
    <td>'.$row['emi3_expected_date'].'</td>
    <td>'.$row['credit_debit_amount1'].'</td>

    <td>'.$row['entry_date2'].'</td>
    <td>'.$row['credit_debit_amount2'].'</td>
    <td>'.$row['total_amount'].'</td>
    <td>'.$due_balance.'</td>
    
    </tr></tbody>';

    $html.='<tfoot><tr>
   
    </tr></tfoot>';

}
$html.='</table>';
 
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=details.xls');
echo $html;
?>