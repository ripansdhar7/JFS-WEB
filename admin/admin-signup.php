<?php

include '../connection.php';

if (isset($_POST['signup'])) {

    $username = ($_POST['username']);
    $pass = ($_POST['password']);
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $cpass = ($_POST['cpassword']);
    $role = ($_POST['role']);


    $select_admins = "SELECT * FROM `admin` WHERE username = '$username'";
    $result = mysqli_query($conn, $select_admins);
    $total = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    // echo $total;

    if ($total > 0) {
        $message[] = 'user already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Passwords does not matched!';
        } else {
            mysqli_query($conn, "INSERT INTO `admin`(`username`, `password`,`role`, `time`) VALUES('$username', '$hash', '$role', current_timestamp())") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:admin-login.php');
        }
    }
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
    <title>Admin registration</title>

    <style>
        html {
            font-size: 100%;
        }
    </style>
</head>

<body>
    <div class="login box-content">
        <div class="input-box">
            <div class="login box-content-left">
                <h1>Welcome!</h1>
                <p>Admin Registration Page</p>
                <img src="../images/Designer.jpg" alt="">
            </div>
            <div class="login box-content-right">

                <form action="#" method="post" class="in-details">
                <?php
					if (isset($message)) {
						foreach ($message as $message) {
							echo '
							<div class="message">
								<span>' . $message . '</span>
								<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
							</div>
							';
						}
					} ?>
                    <div class="input-section">
                        <input type="text" placeholder="Enter Username" name="username" class="input" required>
                    </div>
                    <div class="input-section">
                        <input type="password" placeholder="Enter password" name="password" class="input" required>
                    </div>
                    <div class="input-section">
                        <input type="password" placeholder="Confirm password" name="cpassword" class="input" required>
                    </div>
                    <div class="input-next">
                        <select class="form-select " aria-label="Default select example" style="border-radius: 20vh;width: 50vh;height: 7.5vh; border: 1px solid #CED4DA;
                        box-shadow: none;
                        padding: 0 0 0 15px;
                        background-color: #ffffff;" name="role" required>
                            <option selected>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="smm">Social media manager</option>
                            <option value="pm">Product manager</option>
                        </select>
                    </div>
                    <div class="input-section">
                        <input type="submit" value="Sign up" name="signup" class="input input-btn">
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>