

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
		<title>Admin Login</title>

		<style>
			html{
				font-size: 100%;
			}
		</style>
	</head>
    <body>		
		<div class="login box-content">
			<div class="input-box">
				<div class="login box-content-left">
					<h1>Welcome!</h1>
					<p>Admin Login Page</p>
					<img src="../../images/Designer.jpg" alt="">
				</div>
				<div class="login box-content-right">

					<form action="#" method="post" class="in-details">
						<div class="input-section">
						<input type="text" placeholder="Username" name="username" class="input" required>  
						</div>
						<div class="input-section">
							<input type="password" placeholder="Password" name="password" class="input" required>
						</div>
						<div class="input-next">
							<label><input type="checkbox">Remember Admin</label>
						</div>
						<div class="input-section">
							<input type="submit" value="Log in" name="login" class="input input-btn">
						</div>
					</form> 

					<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
					
				</div>
			</div>
		</div>
	</body>
</html>


<?php

include '../../connection.php';
session_start();

if(isset($_POST['login'])){

   $uname = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = mysqli_real_escape_string($conn,md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `admin_central` WHERE username = '$uname' AND password = '$pass'") or die('query failed');
   $total=mysqli_num_rows($select_users);
   
   
   if(mysqli_num_rows($select_users) > 0){

      while ($row = mysqli_fetch_assoc($select_users)) {

      	
         $_SESSION['admin_username'] = $row['username'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin-dashboard.php');

      }

      /*if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){


      }*/

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>