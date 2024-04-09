<?php
include 'functions/common_function.php';
include 'favicon.php';

include 'connection.php';


if (isset($_POST['signup'])) {

  $fname = ($_POST['first_name']);
  $lname = ($_POST['last_name']);
  $email = ($_POST['email']);
  $pass = ($_POST['password']);
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  $cpass = ($_POST['cpassword']);
  $ip = getIPAddress();


  $select_users = "SELECT * FROM `users` WHERE email = '$email'";
  $result = mysqli_query($conn, $select_users);
  $total = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  // echo $total;

  if ($total > 0) {
    $message[] = 'user already exists!';
  } else {
    if ($pass != $cpass) {
      $message[] = 'Passwords does not matched!';
    } else {
      mysqli_query($conn, "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`,`user_ip`, `date`) VALUES('$fname', '$lname', '$email', '$hash', '$ip', current_timestamp())") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:user-login.php');
    }
  }

}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
  include 'header.php';
  ?>

  <div class="login box-content">

    <div class="input-box">
      <div class="login box-content-left">
        <h1>Sign up!</h1>
        <img src="./images/sofa.png" alt="">
      </div>
      <div class="login box-content-right">
        <form action="#" method="post" class="in-details" style="margin:0;">
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
          <div class="namme-enter">
            <div class="input-section">
              <input type="text" placeholder="First Name" name="first_name" class="input" required>
            </div>
            <div class="input-section">
              <input type="text" placeholder="Last Name" name="last_name" class="input" required>
            </div>
          </div>
          <div class="input-section">
            <input type="email" placeholder="Email" name="email" class="input" required>
          </div>
          <div class="input-section">
            <input type="password" placeholder="Password" name="password" class="input" required>
          </div>
          <div class="input-section">
            <input type="password" placeholder="Confirm password" name="cpassword" class="input" required>
          </div>
          <div class="input-next su">
            <label>
              <p><input type="checkbox" required>Agree to the <a href="#">User Agreement</a> and <a href="#">Privacy
                  Policy</a>.</p>
            </label>
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