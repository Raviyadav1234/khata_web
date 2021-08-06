<?php 

require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';

require('phpmailer/PHPMailerAutoload.php');
require('phpmailer/class.phpmailer.php');
require('phpmailer/class.smtp.php');
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
 
    header("Location:{$base_url}");
}



$today  = date('Y/m/d');

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
FROM users JOIN policy_data ON users.id=policy_data.client_id WHERE emi3_expected_date > $today";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
$rowcount=mysqli_num_rows($result);

$today_date  = strtotime($today);



//One week ago in a YYYY-MM-DD format.
// $lastWeek = date("Y-m-d", strtotime("-7 days"));
// echo $lastWeek, '<br>';
// exit;


if($result){

	for($i=0;$i<$rowcount;$i++){
	$email=$row[$i]['client_email'];
    $exp_date=@$row[$i]['emi3_expected_date'];
	$expire_date = strtotime($exp_date);
	$diff_days = $today_date-$expire_date;
	$remain_date = abs(floor($diff_days/(60*60*24)));
	// echo "<pre>";
	// print_r($remain_date);
	if($remain_date==7){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->Port = "587";
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'tls'; 
		$mail->Username = "Your Email";
		$mail->Password = "Your Email Password";
		$mail->SetFrom("Email from you sent email", "By Ravi");
		$mail->AddAddress($email);
		$mail->addReplyTo('Yoru email for reply ');
		$mail->IsHTML(true);
		$mail->Subject = " From Karoinsure";
		$mail->Body     .= "<h2>You can fill Your EMI-3 before 7 days </h1><br/>"; 
		$mail->Body     .= "Cantact Number:XXXXXXXXX<br/>";
		$mail->Body     .= "Email Number: xyz@gmail.com<br/>";
		
		$send_mail = $mail->Send();

		if($send_mail){
			echo "email sent <br>";
			
		}else{
			echo "email not sent <br>";
		}
		
	}else{
		echo "massage not sent <br>";
	}

}
   

}
