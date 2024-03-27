<?php
include './connection.php';

//products(shop.php)

function get_products() {
    
    global $conn;
    $select_query = "SELECT * FROM `products` order by rand()";
    $result_query = mysqli_query($conn, $select_query);

    while($row = mysqli_fetch_assoc($result_query)){
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['image'];
        echo "<div class='col-12 col-md-4 col-lg-3 mb-5'>
        <a class='product-item' href='shop.php?add_to_cart=$product_id' name='cart'>
            <img src='./admin/uploaded_img/$product_image' class='img-fluid product-thumbnail'>
            <h3 class='product-title'>$product_name</h3>
            <strong class='product-price'>₹$product_price</strong>

            <span class='icon-cross'>
            <img src='images/cross.svg' href='index.php' class='img-fluid'>
            </span>
        </a>
    </div> ";
    }
}



//getting user IP address(cart.php & shop.php)

function getIPAddress() {  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;


//adding product to cart(shop.php)

function cart(){
    if(isset($_GET['add_to_cart'])){
        global $conn;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart` WHERE ip_address='$ip' AND id=$get_product_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if($num_of_rows>0){
            echo "<script>alert('This item is already present in the cart')</script>";
            echo "<script>window.open('shop.php', '_self')</script>";
        }
        else{
            $insert_query = "INSERT INTO `cart` (id, ip_address) values ($get_product_id, '$ip')";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>window.open('shop.php', '_self')</script>";
        }
    }
}

// total price of the cart

function total_cart_price(){
    global $conn;
    $ip = getIPAddress();
    $total = 0;
    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
    $result = mysqli_query($conn, $cart_query);
    while($row=mysqli_fetch_array($result)){
        $product_id = $row['id'];
        $select_products = "SELECT * FROM `products` WHERE id=' $product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while($fetch_cart = mysqli_fetch_array($result_products)){
            $product_price = array($fetch_cart['price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }echo $total;
}
?>