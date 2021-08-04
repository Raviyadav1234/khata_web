<?php
$db_host = "localhost";
$db_user = "root";
//$db_password = "b@k09182736";
$db_password = "";
// Added db for local and stage above
$db_name = "khata_book";

// Create Connection
$conn  = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check Connection
if(!$conn) {
 die("connection failed");
}
?>