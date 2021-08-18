<?php
require __DIR__ .'/config/dbconnection.php';
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
    header("Location:{$base_url}");
}

$file = $_GET['file'];

header("Content-disposition: attachment; filename=" .urlencode($file));
$fb = fopen($file, "r");

while(!feof($fb)){
echo fread($fb, 8192);
flush();
}
fclose($fb);

?>