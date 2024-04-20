<?php

include 'connection.php';
include 'functions/common_function.php';

session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:user-login.php');
// }

if (isset($_GET['cart'])) {
  $cart_id = $_POST['cart_id'];
  $cart_quantity = $_POST['cart_quantity'];
  mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
  $message[] = 'cart quantity updated!';

  $add_id = $_GET['delete'];
  mysqli_query($conn, "INSERT INTO `cart` WHERE id = '$delete_id'") or die('query failed');
  header('location:cart2.php');
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <?php include 'favicon.php'; ?>

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Shop!</title>
</head>

<body>

  <?php
  include 'header.php';
  ?>

  <!-- Start Hero Section -->

  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Shop</h1>
            <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate
              velit imperdiet dolor tempor tristique.</p>

          </div>
        </div>
        <div class="col-lg-7">
          <div class="hero-img-wrap">
            <img src="images/couch.png" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->



  <div class="untree_co-section product-section before-footer-section">
    <div class="container">
      <div class="row">

        <!-- Start Column 1 -->
        <?php
        get_products();
        cart();
        $ip = getIPAddress();
        ?>
        <!-- End Column 1 -->
      </div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>