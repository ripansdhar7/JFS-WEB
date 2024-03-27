<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>User Registration</title>
	</head>

	<body>

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
			
				
                <div class="login box-content">
                    <div class="input-box">
                        <div class="login box-content-left">
							<h1>Sign up!</h1>
							<img src="./images/sofa.png" alt="">
						</div>
                        <div class="login box-content-right">
                            <form action="#" method="post" class="in-details">
                                <div class="namme-enter">
                                    <div class="input-section">
                                        <input type="text" placeholder="First Name" name="first_name" class="input" >
                                    </div>
                                    <div class="input-section">
                                        <input type="text" placeholder="Last Name" name="last_name" class="input" >
                                    </div>
                                </div>
                                <div class="input-section">
                                    <input type="email" placeholder="Email" name="email" class="input" >  
                                </div>
                                <div class="input-section">
                                    <input type="password" placeholder="Password" name="password" class="input" >
                                </div>
                                <div class="input-section">
                                    <input type="password" placeholder="Confirm password" name="cpassword" class="input" >
                                </div>
                                <div class="input-next su">
                                    <label><p><input type="checkbox" required>Agree to the <a href="#">User Agreement</a> and <a href="#">Privacy Policy</a>.</p></label>
                                </div>
                                <div class="input-section">
                                    <input type="submit" value="Join" name="signup" class="input input-btn join">
                                </div>
                                <div class="join-link">
                                    <span>Already have an account?<a href="user-login.php">Log in</a></span>
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

if(isset($_POST['signup'])){

   $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
   $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'Passwords does not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `date`) VALUES('$fname', '$lname', '$email', '$cpass', current_timestamp())") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:user-login.php');
      }
   }

}

?>
