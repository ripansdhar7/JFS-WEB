<?php
include 'connection.php';
include 'functions/common_function.php';

session_start();

$user_id = $_SESSION['user_id'];

$fname = $_SESSION['fname_p'];
$lname = $_SESSION['lname_p'];
$number = $_SESSION['number_p'];
$address = $_SESSION['address_p'];
$email = $_SESSION['email_p'];

if (!isset($id)) {
  header('location:user-login.php');
}

if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
}

$ip = getIPAddress();
?>


<?php
global $conn;
$ip = getIPAddress();
$g_total = 0;
$cart_ip = "SELECT * FROM `cart` WHERE ip_address='$ip'";
$results = mysqli_query($conn, $cart_ip);
$invoice_no = mt_rand();

$count_products = mysqli_num_rows($results);


while ($row_p = mysqli_fetch_array($results)) {
  $quantity = $row_p['quantity'];
  $product = $row_p['id'];
  $select_product = "SELECT * FROM `products` WHERE id=' $product'";
  $result_product = mysqli_query($conn, $select_product);
  while ($fetch = mysqli_fetch_array($result_product)) {
    $price = array($fetch['price']);
    $table = $fetch['price'];
    $values = array_sum($price);

    if ($quantity == 0) {
      $quantity = 1;

    }
    $sub_total = $table * $quantity;
    $g_total += $sub_total;

    $insert_orders = "INSERT INTO `orders`(`user_id`,`first_name`,`last_name`,`number`,`email`,`address`, `quantity`, `product_id`, `total_products`, `price`, `total_price`,`invoice_number`, `placed_on`) VALUES($user_id, '$fname', '$lname', '$number', '$email', '$address', $quantity, $product,'$count_products','$sub_total', '$g_total', '$invoice_no', current_timestamp())";
    $result_query = mysqli_query($conn, $insert_orders);

    if ($result_query) {
      header('location: thankyou.php');
    }

    $insert_pending_orders = "INSERT INTO `orders_pending`(`user_id`,`invoice_number`, `product_id`, `quantity`) VALUES($user_id, '$invoice_no', $product, $quantity)";
    $result_query_p = mysqli_query($conn, $insert_pending_orders);

    $empty_cart = "DELETE FROM `cart` WHERE ip_address='$ip'";
    $result_delete = mysqli_query($conn, $empty_cart);


  }
}

?>