<?php
include 'connection.php';
include 'functions/common_function.php';

session_start();

$id = $_SESSION['user_id'];
$name = $_SESSION['name'];

if (!isset($id)) {
  header('location:user-login.php');
}

if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
}

$ip = getIPAddress();


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
  <title>Your orders</title>
</head>

<body>

  <?php
  include 'header.php';
  ?>
  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Orders</h1>
            <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
              vulputate velit imperdiet dolor tempor tristique.</p>

          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- End Hero Section -->
  <div class="untree_co-section before-footer-section">
    <div class="container">
      <section class="h-100">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">


              <div class="card" style="border-radius: 10px;">
                <?php
                global $conn;
                $ip = getIPAddress();
                $total_p = 0;
                $cart_ip = "SELECT * FROM `cart` WHERE ip_address='$ip'";
                $results = mysqli_query($conn, $cart_ip);
                $invoice_no = mt_rand();
                $status = 'pending';

                $count_products = mysqli_num_rows($results);
                ?>
                <div class="card-header px-4 py-5">
                  <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #3B5D50;">
                      <?php echo $name; ?>
                    </span>!</h5>
                </div>
                <div class="card-body p-4">
                  <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                      <p class="lead fw-normal mb-0" style="color: #3B5D50;">Receipt</p>
                      <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p>
                    </div> -->
                  <?php

                  while ($row_p = mysqli_fetch_array($results)) {
                    //$quantity_p = $row_p['quantity'];
                    $product = $row_p['id'];
                    $select_product = "SELECT * FROM `products` WHERE id=' $product'";
                    $result_product = mysqli_query($conn, $select_product);
                    while ($fetch = mysqli_fetch_array($result_product)) {
                      $price = array($fetch['price']);
                      $table = $fetch['price'];
                      $title = $fetch['name'];
                      $image = $fetch['image'];
                      $values = array_sum($price);
                      // $s_total = $quantity_p * $table;
                      // $total_p += $s_total;
                      $total_p += $values;


                      $get_cart = "SELECT * FROM `cart`";
                      $run_cart = mysqli_query($conn, $get_cart);
                      $get_qty = mysqli_fetch_array($run_cart);
                      $quantity = $get_qty['quantity'];
                      if ($quantity == 0) {
                        $quantity = 1;
                        // $update_cart = " UPDATE `cart` SET quantity=1 WHERE ip_address='$ip'";
                        // $result_products_quantity = mysqli_query($conn, $update_cart);
                        //$s_total = $quantity * $table;
                        $g_total = $total_p;

                      } else {
                        $quantity = $quantity;
                        //$total_p += $s_total;
                        $g_total = $total_p * $quantity;
                        //$total_p += $s_total;
                      }

                      $insert_orders = "INSERT INTO `orders`(`user_id`, `quantity`, `product_id`, `total_products`, `total_price`,`invoice_number`, `placed_on`) VALUES($user_id, $quantity, $product,'$count_products', '$g_total', '$invoice_no', current_timestamp())";
                      $result_query = mysqli_query($conn, $insert_orders);

                      if ($result_query) {
                        echo "<script>alert('Order submitted successfully');</script>";
                        echo "<script>winodw.open('thankyou.php','_self')</script>";
                      }

                      $insert_pending_orders = "INSERT INTO `orders_pending`(`user_id`,`invoice_number`, `product_id`, `quantity`) VALUES($user_id, '$invoice_no', $product, $quantity)";
                      $result_query_p = mysqli_query($conn, $insert_pending_orders);

                      $empty_cart = "DELETE FROM `cart` WHERE ip_address='$ip'";
                      $result_delete = mysqli_query($conn, $empty_cart);


                      ?>

                      <div class="card shadow-0 border mb-4">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-2">
                              <img src="admin/uploaded_img/<?php echo $image; ?>" class="img-fluid" alt="Product">
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0">
                                <?php echo $title; ?>
                              </p>
                            </div>
                            <!-- <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Pink rose</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Capacity: 32GB</p>
                  </div> -->
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0 small">Qty:
                                <?php echo $quantity; ?>
                              </p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0 small">₹
                                <?php echo $table; ?>
                              </p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0 small">Pending payment</p>
                            </div>
                          </div>
                          <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                          <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                              <p class="text-muted mb-0 small">Track Order</p>
                            </div>
                            <div class="col-md-10">
                              <div class="progress" style="height: 6px; border-radius: 16px;">
                                <div class="progress-bar" role="progressbar"
                                  style="width: 20%; border-radius: 16px; background-color: #3B5D50;" aria-valuenow="20"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <div class="d-flex justify-content-around mb-1">
                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php }
                  }

                  ?>


                  <div class="d-flex justify-content-between pt-2">
                    <p class="fw-bold mb-0">Order Details</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> ₹
                      <?php echo $g_total; ?>
                    </p>
                  </div>

                  <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Invoice Number :
                      <?php echo $invoice_no; ?>
                    </p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> -0.00</p>
                  </div>

                  <div class="d-flex justify-content-between">
                    <p class="text-muted mb-0">Invoice Date :
                      <?php ?>
                    </p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
                  </div>

                  <!-- <div class="d-flex justify-content-between mb-5">
                      <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
                      <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                    </div> -->
                </div>
                <div class="card-footer border-0 px-4 py-5"
                  style="background-color: #3B5D50; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                  <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                    paid: <span class="h2 mb-0 ms-2"> ₹
                      <?php echo $g_total; ?>
                    </span></h5>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
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