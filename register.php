<?php 
  include_once("./database/constants.php");
  if (isset($_SESSION["user_id"])) {
    header("location:".DOMAIN."/dashboard.php");
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<!--     <link rel="stylesheet" href="fonts/icomoon/style.css">
 -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
<!--     <link rel="stylesheet" href="css/bootstrap.min.css">
 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link type="text/css" rel="stylesheet" href="./css/styles.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/register.css">

    <title>Inventory Management System | Linkage</title>
  </head>
  <body>
  <div class="overlay">
  <div class="loader"></div>
</div>

  <div class="d-md-flex half">
   <h5 style="position: fixed; z-index: 1000; padding: 10px 30px; color: #fff;"><u>Inventory Management System</u></h5>
     
   
    <div class="bg" style="background-image: url('images/bg_1.jpg');"></div>

    <div class="contents">
      <div class="container">
        <?php 
          if (isset($_GET["msg"]) && !empty($_GET["msg"])) {
            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <?php echo $_GET["msg"]; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

            <?php
          }
     ?>

        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
             
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              <img src="./images/Link.jpg" alt="">

              </div>

                   <form id="register_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                      <label for="username"><b>Full Name</b></label>
                      <input type="text" name="username" class="form-control form-control-sm" id="username" placeholder="Enter Username">
                      <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="email"><b>Email address</b></label>
                      <input type="email" name="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="password1"><b>Password</b></label>
                      <input type="password" name="password1" class="form-control form-control-sm"  id="password1" placeholder="Password">
                      <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="password2"><b>Re-enter Password</b></label>
                      <input type="password" name="password2" class="form-control form-control-sm"  id="password2" placeholder="Password">
                      <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="usertype"><b>Usertype</b></label>
                      <select name="usertype" class="form-control form-control-sm" id="usertype">
                        <option value="">Choose User Type</option>
                        <option value="Admin">Admin</option>
                        <option value="Other">Other</option>
                      </select>
                      <small id="t_error" class="form-text text-muted"></small>
                    </div>
                    <input type="submit" name="user_register" class="btn btn-primary btn-sm" value="Register" style="background-color: #d2ae6d; color: #fff; border-style: none; padding-top: 2px;" >
                    <span><a href="index.php">Login</a></span>
                  </form>

             <!--  <form id="login_form" onsubmit="return false">
                <div class="form-group first">
                  <label for="username">Email</label>
                  <input type="email" class="form-control form-control-sm" name="log_email" id="log_email" placeholder="jdoe@linkageassurance.com">
                   <small id="e_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                   <input type="password" class="form-control form-control-sm" name="log_password" id="log_password" placeholder="Password">
                  <small id="p_error" class="form-text text-muted"></small>
                </div>
                
                

                <input type="submit" value="Log In" class="btn btn-block" style="background-color: #d2ae6d; color: #fff">
                 <span><a href="register.php">Register</a></span>
              </form>
 -->


            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    <script type="text/javascript" src="./js/main.js"></script>
  </body>
</html>