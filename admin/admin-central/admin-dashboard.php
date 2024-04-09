<?php
session_start();

include '../../connection.php';

$role = $_SESSION['role'];
if($role == 'admin'){

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="../../favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		<link href="../style.css" rel="stylesheet">
		<title>Admin panel</title>
	</head>
    <body>
		
		<!-- End Header/Navigation -->

		   
<?php include 'admin-header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>₹<?php echo $total_pendings; ?>/-</h3>
         <p>Total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>₹<?php echo $total_completed; ?>/-</h3>
         <p>Completed payments</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Order placed</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Products added</p>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type='User' ") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Normal users</p>
      </div>
      
      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `admin`  WHERE user_type='Admin'") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Total admins</p>
      </div>


      <!-- <div class="box">
         <?php 
            // $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            // $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php //echo $number_of_account; ?></h3>
         <p>Total accounts</p>
      </div> -->

      <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>New messages</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom admin js file link  -->
<script src="../admin_script.js"></script>


</body>
</html>   

<?php }

else{
   header('location:../admin-login.php');
   }
?> 