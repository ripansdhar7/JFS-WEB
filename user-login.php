<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>User Login</title>
	</head>

	<body>

			<!-- Start Header/Navigation -->
			<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

				<div class="container">
					<a class="navbar-brand" href="index.html">Furni<span>.</span></a>
	
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
	
					<div class="collapse navbar-collapse" id="navbarsFurni">
						<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
							<li class="nav-item ">
								<a class="nav-link" href="index.html">Home</a>
							</li>
							<li><a class="nav-link" href="shop.html">Shop</a></li>
							<li><a class="nav-link" href="about.html">About us</a></li>
							<li><a class="nav-link" href="services.html">Services</a></li>
							<li><a class="nav-link" href="blog.html">Blog</a></li>
							<li><a class="nav-link" href="contact.html">Contact us</a></li>
						</ul>
	
						<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
							<li><a class="nav-link" href="user-login.html"><img src="images/user.svg"></a></li>
							<li><a class="nav-link" href="cart.html"><img src="images/cart.svg"></a></li>
						</ul>
					</div>
				</div>
					
			</nav>
			<!-- End Header/Navigation -->
					<!-- Start Hero Section -->

				<div class="login box-content">
					<div class="input-box">
						<div class="login box-content-left">
							<h1>Log in!</h1>
							<img src="./images/sofa.png" alt="">
						</div>
						<div class="login box-content-right">

							<?php
								if(isset($message)){
								   foreach($message as $message){
								      echo '
								      <div class="message">
								         <span>'.$message.'</span>
								         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
								      </div>
								      ';
								   }
								}
								?>

							<form action="#" method="post" class="in-details">

								<div class="input-section">
								<input type="email" placeholder="Email or Username" name="email" class="input" required>  
								</div>
								<div class="input-section">
									<input type="password" placeholder="Password" name="password" class="input" required>
								</div>
								<div class="input-next">
									<label><input type="checkbox">Remember me</label>
									<a href="#">Forgot Password?</a>
								</div>
								<div class="input-section">
									<input type="submit" value="Log in" name="login" class="input input-btn">
								</div>
								<div class="join-link">
									<span>Don't have an account?<a href="user-signup.html">Sign up</a></span>
								</div>
							</form> 
							
						</div>
					</div>
				</div>
				
			<!-- End Hero Section -->
	</body>	
</html>







<?php

include 'connection.php';
session_start();

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   $total=mysqli_num_rows($select_users);
   echo $total;
   if(mysqli_num_rows($select_users) > 0){

      while ($row = mysqli_fetch_assoc($select_users)) {

      	// $_SESSION['first_name'] = $row['fname'];
      	 //$_SESSION['last_name'] = $row['lname'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
        // header('location:index.php');

      }

      /*if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){


      }*/

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>