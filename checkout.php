<?php
include 'connection.php';
include 'functions/common_function.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:user-login.php');
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
  <title>Checkout products</title>
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
            <h1>Checkout</h1>
          </div>
        </div>
        <div class="col-lg-7">

        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <div class="untree_co-section">
    <form action="" method="post">
      <div class="container">
        <div class="row mb-5">
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border bg-white">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="fname" name="fname" required>
                </div>

                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street address"
                    required>
                </div>
              </div>

              <div class="form-group mt-3">
                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">State<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="zip" name="zip" required>
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email Address <span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number"
                    maxlength="10" required>
                </div>
              </div>

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                  placeholder="Write your notes here..."></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <?php
                global $conn;
                $ip = getIPAddress();
                $total_p = 0;
                $cart_ip = "SELECT * FROM `cart` WHERE ip_address='$ip'";
                $results = mysqli_query($conn, $cart_ip);


                if (mysqli_num_rows($results) > 0) {

                  ?>
                  <div class="p-3 p-lg-5 border bg-white">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Product</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <?php
                        while ($row_p = mysqli_fetch_array($results)) {
                          $quantity_p = $row_p['quantity'];
                          $product = $row_p['id'];
                          $select_product = "SELECT * FROM `products` WHERE id=' $product'";
                          $result_product = mysqli_query($conn, $select_product);
                          while ($fetch = mysqli_fetch_array($result_product)) {
                            $price = array($fetch['price']);
                            $table = $fetch['price'];
                            $title = $fetch['name'];
                            $image = $fetch['image'];
                            $values = array_sum($price);
                            $s_total = $quantity_p * $table;
                            $total_p += $s_total;
                            $_SESSION['g_total'] = $total_p;
                            ?>

                            <?php
                            echo "<tr>
														<td>$title<strong class='mx-2'>x</strong>$quantity_p</td>
														<td>₹$s_total</td>
													</tr>";
                          }
                        } ?>

                        <tr>
                          <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                          <td class="text-black font-weight-bold"><strong>₹
                              <?php echo $total_p; ?>
                            </strong></td>
                        </tr>

                      <?php } ?>
                    </tbody>
                  </table>

                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75 couponcode-wrap mb-5">
                    <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code"
                      aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>

                  <div class="form-group">
                    <!-- <a href="payment.php" class="btn btn-black btn-med py-3 btn-block">Pay now</a> -->
                    <!-- <button id="rzp-button1" class="btn btn-black btn-med py-3 btn-block">Pay now</button> -->
                    <input type="button" class="btn btn-black btn-med py-3 btn-block" id="pay" name="pay"
                      value="Pay now" onclick="pay_now()">
                    <!-- onclick="window.location='thankyou.php'">Place Order-->
                  </div>
                </div>
              </div>
            </div>
          </div>
    </form>
  </div>

  <!-- </form> -->
  </div>
  </div>

  <?php
  include 'footer.php';
  ?>


  <script>
    function pay_now() {
      var fname = jQuery('#fname').val();
      var lname = jQuery('#lname').val();
      var address = jQuery('#address').val();
      var state = jQuery('#state').val();
      var zip = jQuery('#zip').val();
      var email = jQuery('#email').val();
      var phone = jQuery('#phone').val();

      jQuery.ajax({
        type: 'post',
        url: 'payment_process.php',
        data: "&fname=" + fname + "&lname=" + lname + "&address=" + address + "&state=" + state + "&zip=" + zip + "&email=" + email + "&phone=" + phone ,
        success: function (result) {
          var options = {
            "key": "rzp_test_rda5tZeYsvjVsy",
            "amount": "<?php echo $total_p * 100; ?>",
            "currency": "INR",
            "name": "Furni",
            "description": "Test Transaction",
            "image": "favicon.png",
            "handler": function (response) {
              jQuery.ajax({
                type: 'post',
                url: 'payment_process.php',
                data: "payment_id=" + response.razorpay_payment_id,
                success: function (result) {
                  window.location.href = "orders.php";
                }
              });
            }
          };
          var rzp1 = new Razorpay(options);
          rzp1.open();
        }
      });
    }
  </script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>