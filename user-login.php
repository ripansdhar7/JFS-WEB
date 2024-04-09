<?php

include 'connection.php';
session_start();
// $loggedin = false;

if (isset($_POST['login'])) {

  $email = ($_POST['email']);
  $pass = ($_POST['password']);

  $select_users = "SELECT * FROM `users` WHERE email = '$email'";
  $result = mysqli_query($conn, $select_users);
  $total = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  // echo $total;
  if ($total > 0) {
    if (password_verify($pass, $row['password'])) {
      $_SESSION['fname'] = $row['first_name'];
      $_SESSION['lname'] = $row['last_name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id'];
      // $loggedin = true;
      // echo "<script>alert('login successfull')</script>";		
      header('location:index.php');
    } else {
      $message[] = 'incorrect email or password!';
    }

    /*if($row['user_type'] == 'admin'){

           $_SESSION['admin_name'] = $row['name'];
           $_SESSION['admin_email'] = $row['email'];
           $_SESSION['admin_id'] = $row['id'];
           header('location:admin_page.php');

          }elseif($row['user_type'] == 'user'){


          }*/

  } else {
    $message[] = 'incorrect email or password!';
  }

}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include 'favicon.php'; ?>

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
  <?php
  include 'header.php';
  ?>
  <!-- Start Hero Section -->

  <div class="login box-content">
    <div class="input-box">
      <div class="login box-content-left">
        <h1>Log in!</h1>
        <img src="./images/sofa.png" alt="">
      </div>
      <div class="login box-content-right">


        <form action="#" method="post" class="in-details">

          <?php
          if (isset($message)) {
            foreach ($message as $message) {
              echo '
							<div class="message">
								<span>' . $message . '</span>
								<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
							</div>
							';
            }
          } ?>
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
            <span>Don't have an account?<a href="user-signup.php">Sign up</a></span>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- End Hero Section -->
</body>

</html>