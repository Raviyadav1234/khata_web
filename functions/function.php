<?php

$base_url = "http://localhost:8000/khata";
 //$base_url = "http://142.93.208.168/khata";


//function for data sanatisation
function sanatise($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>