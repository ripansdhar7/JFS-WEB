<?php
include './connection.php';

//products(shop.php)

function get_products()
{

  global $conn;
  $select_query = "SELECT * FROM `products` order by rand()";
  $result_query = mysqli_query($conn, $select_query);

  while ($row = mysqli_fetch_assoc($result_query)) {
    $product_id = $row['id'];
    $product_name = $row['name'];
    $product_price = $row['price'];
    $product_image = $row['image'];

    if (isset($_SESSION ['user_id'])) {
    echo "<div class='col-12 col-md-4 col-lg-3 mb-5'>
        <div class='product-item'>
            <img src='./admin/uploaded_img/$product_image' class='img-fluid product-thumbnail'>
            <h3 class='product-title'>$product_name</h3>
            <strong class='product-price'>₹$product_price</strong>

            <span class='icon-cross'>
           
              <a class='img-fluid' href='shop.php?add_to_cart&id=$product_id&price=$product_price' name='cart'><img src='images/cross.svg' class='img-fluid'></a>

            </span>
        </div>
    </div> ";
          } else {
            echo "<div class='col-12 col-md-4 col-lg-3 mb-5'>
            <div class='product-item'>
                <img src='./admin/uploaded_img/$product_image' class='img-fluid product-thumbnail'>
                <h3 class='product-title'>$product_name</h3>
                <strong class='product-price'>₹$product_price</strong>
    
                <span class='icon-cross'>
                  <a class='img-fluid' href='user-login.php'><img src='images/cross.svg' class='img-fluid'></a>
                </span>
            </div>
        </div> ";
          }
  }
}



//getting user IP address(cart.php & shop.php)

function getIPAddress()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;


//adding product to cart(shop.php)

function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $ip = getIPAddress();
    $get_product_id = $_GET['id'];
    $price = $_GET['price'];
    $select_query = "SELECT * FROM `cart` WHERE ip_address='$ip' AND id=$get_product_id AND price=$price ";
    $result_query = mysqli_query($conn, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);

    if ($num_of_rows > 0) {
      echo "<script>alert('This item is already present in the cart')</script>";
      echo "<script>window.open('shop.php', '_self')</script>";
    } else {
      $insert_query = "INSERT INTO `cart` (id, user_id, ip_address, price) values ($get_product_id,'$user_id','$ip',$price)";
      $result_query = mysqli_query($conn, $insert_query);
      echo "<script>window.open('shop.php', '_self')</script>";
    }
  }
}

// total price of the cart

function total_cart_price()
{
  global $conn;
  $ip = getIPAddress();
  $total = 0;
  $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
  $result = mysqli_query($conn, $cart_query);
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['id'];
    $select_products = "SELECT * FROM `products` WHERE id=' $product_id'";
    $result_products = mysqli_query($conn, $select_products);
    while ($fetch_cart = mysqli_fetch_array($result_products)) {
      $product_price = array($fetch_cart['price']);
      $product_values = array_sum($product_price);
      $total += $product_values;
    }
  }
  echo $total;
}
?>