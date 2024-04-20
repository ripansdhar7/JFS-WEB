<?php

include 'connection.php';
include 'functions/common_function.php';

session_start();

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
  header('location:cart.php');
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
  <title>Cart</title>
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
            <h1>Cart</h1>
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
    global $conn;
    $ip = getIPAddress();
    $total = 0;
    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
    $result = mysqli_query($conn, $cart_query);


    if (mysqli_num_rows($result) > 0) {

      ?>

      <div class="container">
        <form action='' class="col-md-12" method="post">

          <div class="row mb-5">
            <div class="site-blocks-table">
              <tbody>
                <table class="table">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">Image</th>
                      <th class="product-name">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th class="product-total">Total</th>
                      <th class="product-remove">Remove</th>
                    </tr>
                  </thead>
                  <?php

                  // while($fetch_cart = mysqli_fetch_assoc($select_cart)){	
                  while ($row = mysqli_fetch_array($result)) {
                    $quantity = $row['quantity'];
                    $product_id = $row['id'];
                    $_SESSION['productId'] = $product_id;
                    $select_products = "SELECT * FROM `products` WHERE id=' $product_id'";
                    $result_products = mysqli_query($conn, $select_products);
                    while ($fetch_cart = mysqli_fetch_array($result_products)) {
                      $product_price = array($fetch_cart['price']);
                      $product_table = $fetch_cart['price'];
                      $product_title = $fetch_cart['name'];
                      $product_image = $fetch_cart['image'];
                      $product_values = array_sum($product_price);
                      ?>

                      <tr>
                        <td class="product-thumbnail">
                          <img src="admin/uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="Image" class="img-fluid">
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black">
                            <?php echo $fetch_cart['name']; ?>
                          </h2>
                        </td>
                        <td>₹
                          <?php echo $product_table ?>/-
                        </td>
                        <td>
                          <!-- <div class="input-group d-flex align-items-center justify-self-center quantity-container"
                            style="max-width: 90px;">
                            <input type="number" name="qty" value="" min="1"
                              class="input-group d-flex align-items-center justify-self-center quantity-container"
                              style="max-width: 90px; outline: none; border: 1px solid black; border-radius: 5px;" required>
                            <input type="hidden" name="cart_id" value="">
                          </div> -->

                          <!-- <div class="input-group " style="width: 10rem;">
                            <div class="input-group-prepend">
                              <button class="input-group-text">-</button>
                            </div>
                            <input type="text" class="form-control mx-1" aria-label="Amount (to the nearest dollar)" style="height: 2.4rem;">
                            <div class="input-group-append">
                              <button class="input-group-text">+</button>
                            </div>
                          </div> -->

                          <div class="input-group mx-auto d-flex align-items-center quantity-container qtyBox"
                            style="max-width: 120px;">
                            <input type="hidden" name="cart_id" value="<?php echo $product_id; ?>" class="prodId">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-black decrease" type="button" name="set-qty">&minus;</button>
                              <!-- <input type="submit" class="btn btn-outline-black decrease" type="button" name="set-qty" value="-"> -->
                            </div>
                            <input type="text" class="form-control text-center quantity-amount qty"
                              value="<?php echo $quantity; ?>" placeholder="" aria-label="Example text with button addon"
                              aria-describedby="button-addon1" name="input-qty">
                            <div class="input-group-append">
                              <button class="btn btn-outline-black increase" type="button" name="set-qty">&plus;</button>
                            </div>
                          </div>
                        </td>



                        <td>₹
                          <?php echo $sub_total = $quantity * $product_table; ?>/-
                        </td>
                        <td><a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>"
                            onclick="return confirm('delete this from cart?');" class="btn btn-black btn-sm">X</a></td>
                      </tr>

                      <?php
                    }
                    $ip = getIPAddress();
                    if (isset($_POST['update_cart'])) {
                      $cart_id = $_POST['cart_id'];
                      $quantities = $_POST['input-qty'];
                      $update_cart = " UPDATE `cart` SET quantity=$quantities WHERE id=$cart_id AND ip_address='$ip'";
                      $result_products_quantity = mysqli_query($conn, $update_cart);
                    }
                    $total += $sub_total;
                  }
                  ?>
              </tbody>
              </table>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
              <div class="row mb-5 d-flex flex-column">
                <div class="col-md-6 mb-3 ">

                  <input type="submit" value='Update Cart' class='btn btn-black btn-med btn-block' name='update_cart'>
                </div>
                <div class="col-md-6">
                  <a href="shop.php" class="btn btn-black btn-med py-3 btn-block">Continue Shopping</a>

                </div>
              </div>
            </div>
            <div class="col-md-6 pl-5">
              <div class="row justify-content-end">
                <div class="col-md-7">

                  <div class="row">
                    <div class="col-md-12 text-right border-bottom mb-5">
                      <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                    </div>
                  </div>

                  <div class="row mb-5">
                    <div class="col-md-6">
                      <span class="text-black">Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black">₹
                        <?php echo $total; ?>/-</span>
                      </strong>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <a href="checkout.php"
                        class="btn btn-black btn-lg py-3 btn-block <?php echo ($total > 1) ? '' : 'enabled'; ?>">Proceed
                        To Checkout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
    } else {
      echo "<h2 class='section-title d-flex justify-content-center text-center'>Your cart is empty!</h2>";
    }
    ?>
    </div>

  </div>


  <?php
  include 'footer.php';
  ?>


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>

  <!-- <script>
    $(document).ready(function () {

      $(document).on('click', '.increase', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var $productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
          var qtyVal = currentValue + 1;
          $quantityInput.val(qtyVal);
          quantityIncDec(productId, qtyVal);
        }
      });

      $(document).on('click', '.decrease', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var $productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
          var qtyVal = currentValue - 1;
          $quantityInput.val(qtyVal);
          quantityIncDec(productId, qtyVal);
        }
      });

      function quantityIncDec(prodId, qty) {
        $.ajax({
          type: "POST",
          url: "orders-code.php",
          data: {
            'productIncDec': true,
            'product_id': prodId,
            'quantity': qty
          },

          success: function (response) {
            var res = JSON.parse(response);

            if (response.status == 200) {
              window.location.reload();
            }
          }
        });
      }
    });

  </script> -->
</body>

</html>