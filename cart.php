<?php

include 'connection.php';
include 'functions/common_function.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:user-login.php');
// }

// if(isset($_POST['update_cart'])){
//    //$cart_id = $_POST['cart_id'];
//    $cart_quantity = $_POST['cart_quantity'];
//    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
//    $message[] = 'cart quantity updated!';
// }


									
									


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

// $ip = getIPAddress();
// $cart_id = $_POST['cart_id'];
// $cart = "SELECT * FROM `cart` WHERE ip_address='$ip' AND id = '$cart_id'";
// $result = mysqli_query($conn, $cart);
// while( $fetch = mysqli_fetch_assoc($result)){
// 	$quantity = $fetch['quantity'];
// 	$price = $fetch['price'];
// }





// if(isset($_GET['delete_all'])){
//    mysqli_query($conn, "DELETE FROM `cart` WHERE ip_address = '$ip'") or die('query failed');
//    header('location:cart.php');
// }

$ip = getIPAddress()
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

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

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.html">Furni<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li><a class="nav-link" href="shop.php">Shop</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						<li><a class="nav-link" href="services.php">Services</a></li>
						<li><a class="nav-link" href="blog.php">Blog</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<li><a class="nav-link" href="user-login.php"><img src="images/user.svg"></a></li>
						<li><a class="nav-link" href="cart.php"><img src="images/cart.svg"></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->
		<!-- Start Hero Section -->

		<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
								<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
							
							</div>
						</div>

					</div>
				</div>
			</div>
		<!-- End Hero Section -->

	<div class="untree_co-section before-footer-section">
			<?php
			// $grand_total = 0;
			// $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE ip_address = '$ip'") or die('query failed');
			// if(mysqli_num_rows($select_cart) > 0){?>
			<?php
				global $conn;
				$ip = getIPAddress();
				$total = 0;
				$cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
				$result = mysqli_query($conn, $cart_query);
				
				
				if(mysqli_num_rows($result) > 0){

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
										while($row=mysqli_fetch_array($result)){
											$quantity = $row['quantity'];
											$product_id = $row['id'];
											$select_products = "SELECT * FROM `products` WHERE id=' $product_id'";
											$result_products = mysqli_query($conn, $select_products);
											while( $fetch_cart = mysqli_fetch_array($result_products)){
												$product_price = array( $fetch_cart['price']);
												$product_table = $fetch_cart['price'];
												$product_title = $fetch_cart['name'];
												$product_image = $fetch_cart['image'];
												$product_values = array_sum($product_price);
										// 		$total += $product_values;
										// ?>
									
										<tr>
											<td class="product-thumbnail">
												<img src="admin/uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="Image" class="img-fluid">
											</td>
											<td class="product-name">
												<h2 class="h5 text-black"><?php echo $fetch_cart['name']; ?></h2>
											</td>
											<td>₹<?php echo $product_table ?>/-</td>
											<td>
												<div class="input-group d-flex align-items-center justify-self-center quantity-container" style="max-width: 90px;">
												<!-- <div class="input-group-prepend">
													<button class="btn btn-outline-black decrease" type="button">&minus;</button>
												</div>
												<input type="text" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
												<div class="input-group-append">
													<button class="btn btn-outline-black increase" type="button">&plus;</button>
												</div> -->

												<input type="number" name="qty" value="<?php echo $row['quantity']; ?>" min="1" class="input-group d-flex align-items-center justify-self-center quantity-container"  style="max-width: 90px; outline: none;" required >
												<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
												</div>
											</td>



											<td>₹<?php echo $sub_total = $quantity * $product_table;?>/-</td>
											<td><a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('delete this from cart?');" class="btn btn-black btn-sm">X</a></td>
										</tr>
										
									<?php
											}$ip = getIPAddress();
											if(isset($_POST['update_cart'])){
												$cart_id = $_POST['cart_id'];
												$quantities = $_POST['qty'];	
												$update_cart = " UPDATE `cart` SET quantity=$quantities WHERE id='$cart_id' AND ip_address='$ip'";
												$result_products_quantity = mysqli_query($conn, $update_cart);
												// $total = $total*$quantities;																						
											}
											$total += $sub_total;}
										
									//$grand_total += $sub_total;} 
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
										<strong class="text-black" >₹<?php echo $total ?>/-</span></strong>
										</div>
									</div>
						
									<div class="row">
										<div class="col-md-12">										
										<a href="checkout.php" class="btn btn-black btn-lg py-3 btn-block <?php echo ($total > 1)?'':'enabled'; ?>" >Proceed To Checkout</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>	
			<?php
				}
				else 
				{
					echo "<h2 class='section-title d-flex justify-content-center text-center'>Your cart is empty!</h2>";
				}
				?>
		</div>

			

		
	 
	</div>















		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>


				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
