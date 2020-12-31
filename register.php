<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="description" content="Inventory Management System">
  	<meta name="author" content="Software Angle">
  	<meta name="keyword" content="">
 	<link rel="shortcut icon" href="img/favicon.png">

  	<title>Inventory Management System</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="overlay">
	<div class="loader"></div>
</div>

<!-- Navbar -->
<section >
	<?php include_once('./templates/header.php'); ?>
</section>



<section style="margin-top: 15px;">
	<div class="container" style="font-size: 14px; font-family: Roboto">
		<div class="card mx-auto" style="width: 20rem;  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
	        <img src="./images/login.jpg" class="card-img-top" alt="..." height="150px">
		      <div class="card-body">
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
		          <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
		          <span><a href="index.php">Login</a></span>
		        </form>
		      </div>
	    </div>
	</div>
</section>









<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/main.js"></script>
	
</body>
</html>
