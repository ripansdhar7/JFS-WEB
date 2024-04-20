<?php
include 'connection.php';
include 'functions/common_function.php';

session_start();


$name = $_SESSION['fname'];
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:user-login.php');
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
    <?php
    $orders = "SELECT * FROM `orders` WHERE user_id = '$user_id' ";
    $order_query = mysqli_query($conn, $orders);

    if (mysqli_num_rows($order_query) > 0) {

      ?>

      <div class="container">
        <section class="h-100">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-lg-10 col-xl-8">


                <div class="card" style="border-radius: 10px;">
                  <?php
                  $g_total = 0;
                  $orders = "SELECT * FROM `orders` WHERE user_id = '$user_id' ";
                  $query = mysqli_query($conn, $orders);

                  $count = mysqli_num_rows($query);
                  ?>

                  <div class="card-header px-4 py-5">
                    <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #3B5D50;">
                        <?php echo $name; ?>
                      </span>!</h5>
                  </div>
                  <div class="card-body p-4">

                    <?php
                    while ($fetch = mysqli_fetch_array($query)) {
                      $qty = $fetch["quantity"];
                      $invoice_no = $fetch["invoice_number"];
                      $time = $fetch["placed_on"];
                      $status = $fetch["payment_status"];
                      $product_id = $fetch['product_id'];

                      ?>
                      <?php
                      $select = "SELECT * FROM `products` WHERE id= '$product_id'";
                      $result = mysqli_query($conn, $select);
                      while ($fetch_pr = mysqli_fetch_array($result)) {
                        $price = array($fetch_pr['price']);
                        $table = $fetch_pr['price'];
                        $title = $fetch_pr['name'];
                        $image = $fetch_pr['image'];
                        $values = array_sum($price);
                  
                        $sub_total = $qty * $table;
                        $g_total += $sub_total;
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

                              <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Qty:
                                  <?php echo $qty; ?>
                                </p>
                              </div>
                              <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">₹
                                  <?php echo $sub_total = $qty * $table; ?>/-
                                </p>
                              </div>
                              <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">
                                  <?php echo $status; ?>
                                </p>
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
                                    aria-valuemin="0" aria-valuemax="100">
                                  </div>
                                </div>
                                <div class="d-flex justify-content-around mb-1">
                                  <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary
                                  </p>
                                  <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php }
                    } ?>


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
                        <?php echo $time; ?>
                      </p>
                      <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
                    </div>

                  </div>
                  <div class="card-footer border-0 px-4 py-5"
                    style="background-color: #3B5D50; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                      Total
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
      <?php
    } else {
      echo "<h2 class='section-title d-flex justify-content-center text-center'>You haven't ordered anything yet!</h2>";
    }
    ?>
  </div>

  <?php
  include 'footer.php';
  ?>


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>