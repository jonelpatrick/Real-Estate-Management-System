<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Real estate management System - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style type="text/css">
      .col-lg-7 img{
        width:100%;
        margin-top: 15%;
      }
      .col-lg-5{
          border-left: 1px solid rgba(0,0,0,0.1);
      }
      p{
        color:#fff;
        text-align: center;
         padding: 20px;
        font-size: 13px;
      }
      h1{
        text-align: center;
        font-size: 35px;
      }
    </style>
  </head>

  <body class="">

    <div class="container2" >
      <div class="row">
        <div class="col-lg-7" style="margin-right: 0;padding-right: 0;">
            <img src="system-images/rems-management.jpg" />
        </div>
    <div class="col-lg-5" style="    margin-bottom: 2em;    text-align: center;">
    <img style="width: 400px;margin-top: 10%;" src="system-images/realty-logo.png" />
      <h1 style="margin-top: 0.5em;">Real Estate Management<br> System</h1>
         <div class="card card-login mx-auto mt-5">
          <div class="card-header" style="background: #f4e086;">Login to our system</div>
          <div class="card-body">
            <?php
               session_set_cookie_params(600);
               session_start();
               
              if(isset($_SESSION['ERR'])){
                echo '<label style="color:red;">'.$_SESSION['ERR'].'</label>';       
                $_SESSION['ERR'] = '';        
              }
              
            ?>
           
            <form method="POST" action="snippet/login.php">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" required="required" autofocus="autofocus">
                  <label for="inputUsername">Username</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <!--
              <div class="form-group inline-layout">                    
                  <label class="radio-inline" style="margin-right: 10px;">
                    <input type="radio" name="user_type" value="0" checked> Customer
                  </label>
                  <label class="radio-inline" style="margin-right: 10px;">
                    <input type="radio" name="user_type" value="1"> Client 
                  </label>
                  <label class="radio-inline" style="margin-right: 10px;">
                    <input type="radio" name="user_type" value="2"> Employee
                  </label>
              </div>
              -->
              <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
            </form>
            <div class="text-center">
              <!--<a class="d-block small mt-3" href="register.php">Register an Account</a>-->
              <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
            </div>
          </div>
        </div>
    </div>

    </div><!-- row-->
    </div>
    <div class="bg-dark">
      <p>Real estate management System Copyright 2018</p>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
