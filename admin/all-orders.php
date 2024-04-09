<?php

session_start();

include '../connection.php';

// if(($_SESSION['admin_id']) OR ($_SESSION['admin_order_id']))
$role = $_SESSION['role'];
if($role == 'pm' OR $role == 'admin')
{  


   if(isset($_POST['update_order'])){

      $order_update_id = $_POST['order_id'];
      $update_payment = $_POST['update_payment'];
      mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
      $message[] = 'payment status has been updated!';

   }

   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
      header('location:admin_orders.php');
   }

   ?>
   <!doctype html>
   <html lang="en">
   <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="shortcut icon" href="../favicon.png">

   <meta name="description" content="" />
   <meta name="keywords" content="bootstrap, bootstrap4" />

         <!-- Bootstrap CSS -->
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
         <link href="../css/bootstrap.min.css" rel="stylesheet">
         <link href="style.css" rel="stylesheet">
         <title>Order management</title>
         
      </head>
      <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark admin" arial-label="Furni navigation bar">

      <div class="container">
         <a class="navbar-brand" href="admin-main.html">Order Mangement Pannel<span>.</span></a>

      
   </nav>
   <!-- End Header/Navigation -->
      <body>


   <section class="orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
         ?>
         <div class="box">
            <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
            <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
            <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
            <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p> total price : <span>₹<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
            <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
            <form action="" method="post">
               <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
               <select name="update_payment">
                  <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                  <option value="pending">pending</option>
                  <option value="completed">completed</option>
               </select>
               <input type="submit" value="Update" name="update_order" class="option-btn">
               <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Delete</a>
            </form>
         </div>
         <?php
            }
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>

   <!-- custom admin js file link  -->
   <script src="admin_script.js"></script>

   </body>
   </html>

   <?php

}
else{
   header('location:admin-login.php');
   }

?>