<?php
include 'functions/function.php';
session_start();
 session_destroy();
header("Location:{$base_url}");
?>