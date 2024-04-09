<?php

include '../connection.php';

session_start();

// if(($_SESSION['admin_id']) OR ($_SESSION['admin_product_id']))
$role = $_SESSION['role'];
if($role == 'smm' OR $role == 'admin')
{  

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
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
         <title>Message management</title>
      </head>
      <body>
         <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark admin" arial-label="Furni navigation bar">

            <div class="container">
               <a class="navbar-brand" href="admin-main.html">Message pannel<span>.</span></a>
               
         </nav>
         <!-- End Header/Navigation -->
   <main>  

   <section class="messages">

      <h1 class="title"> messages </h1>

      <div class="box-container">
      <?php
         $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
         if(mysqli_num_rows($select_message) > 0){
            while($fetch_message = mysqli_fetch_assoc($select_message)){
         
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
         <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
         <p> message : <span><?php echo $fetch_message['message']; ?></span> </p>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
      </div>
      <?php
         };
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
      </div>

   </section>
   </main> 









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