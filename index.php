<?php
require_once __DIR__.'/admin/config/dbconnection.php';
include 'functions/function.php';
session_start();
if(!isset($_SESSION['is_login'])){
  if(isset($_POST['email'])){
    if($_POST['email']=="" || $_POST['password']==""){
$msg = '<div class="alert alert-danger mt-2" role="alert"> All Fields are Required </div>';
header("Refresh:2; url={$base_url}");
    }else{
    // $email = sanatise($_POST['email']);
    // $password = sanatise($_POST['password']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    
     $sql = "SELECT email, password FROM tbl_login WHERE email='".$email."' AND password='".$password."' limit 1";
  
   //SELECT email, password FROM tbl_login WHERE email='raviyadav2017sln@gmail.com' AND password=''' ' or'1=1' limit 1
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
      
      $_SESSION['is_login'] = true;
      $_SESSION['email'] = $email;
      
       $msg = '<div class="alert alert-success col-sm-12 ml-5 mt-2" role="alert">You are Redirecting...</div>';
      
       header("Refresh:3; url={$base_url}/admin/dashboard.php");
  
    } else {
      $msg = '<div class="alert alert-danger text-center" role="alert">
      Invalid Email or Password!!
    </div>';
     header("Refresh:2; url={$base_url}");
    }
    }
  }
} else {
  header("Location:{$base_url}/admin/dashboard.php");
}

//' ' or'1=1
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Karoinsure Khata</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
      <!--Main Navigation-->
  <header>
    <style>
      #intro {
        background-image: url(https://mdbootstrap.com/img/new/fluid/city/008.jpg);
        height: 100vh;
      }
      .wyt
      {
        color:#fff;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>

    <!-- Navbar -->
 
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
            <?php if(isset($msg)) {print($msg); } ?>
              <h2 class="wyt">Karoinsure Khata</h2>
              <form class="bg-white rounded shadow-5-strong p-5" action="" method="POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control" />
                  <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="password" class="form-control"/>
                  <label class="form-label" for="password">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                  <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                      <label class="form-check-label" for="form1Example3">
                        Remember me
                      </label>
                    </div>
                  </div>

                  <div class="col text-center">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                  </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block" name="btn">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->

  <!--Footer-->
  <p class="text-center pt-lg-3"> &copy; Karoinsure 2021, All Rights Reserved.</p>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>