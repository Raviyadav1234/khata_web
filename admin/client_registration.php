<?php
// require __DIR__ .'/config/dbconnection.php';
include("config/dbconnection.php");
require __DIR__.'/functions/function.php';
session_start();
if(@$_SESSION['is_login']){
 $email = @$_SESSION['email'];
}else{
 // echo "<script> location.href='../index.php'; </script>";
    header("Location:{$base_url}");
}

if(isset($_POST['submit_btn'])){

      $name = sanatise($_POST['client_name']);
      $email = sanatise($_POST['client_email']);
      $mobile = sanatise($_POST['client_mobile']);
if($name=="" || $email=="" || $mobile==""){
	$msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
      header("Refresh:2; url={$base_url}/admin/client_registration.php");
}else{
$sql = "INSERT INTO users(client_name, client_email, client_mobile) VALUES ('$name', '$email', '$mobile')";
   $result = mysqli_query($conn,$sql);
 
    
    if($result){
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Client Register Successfully </div>';
    
      header("Refresh:2; url={$base_url}/admin/client_registration.php");
    }else{
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Register</div>';
       header("Refresh:2; url={$base_url}/admin/client_registration.php");
    }
}

   

   
   }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Karoinsure Khata Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <?php require_once  'includes/sidebar.php';?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once 'includes/header.php';?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if(isset($msg)){echo $msg;}?>
                    <h1>Register Here</h1>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                    <!-- Page Heading -->
                    
                    <form method="POST" id="myform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Client Name</label>
                            <input type="text" name="client_name" class="form-control" id="exampleFormControlInput1" placeholder="Rishi Mathur" required >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" name="client_email" class="form-control" id="exampleFormControlInput1" placeholder="rish.mathur@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Mobile Number</label>
                            <input type="text" name="client_mobile" class="form-control" id="exampleFormControlInput1" placeholder="9887589678" required>
                        </div>

                  
                        <button type="submit" class="btn btn-primary mb-2" name="submit_btn">Submit</button>
                      
                      </form>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?php require_once  'includes/footer.php';?>




 