<?php
include 'connection.php';
include 'functions/common_function.php';
session_start();
include 'favicon.php';

$user_id = $_SESSION['user_id'];

$f_name = $_SESSION['fname'];
$l_name = $_SESSION['lname'];

if (!isset($user_id)) {
    header('location:user-login.php');
}

if (isset($_GET['edit_profile'])) {
    $user_name = $_SESSION['user_email'];
    $select_query = "SELECT * FROM `users` WHERE email='$user_name'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['id'];
    $user_f_name = $row_fetch['first_name'];
    $user_l_name = $row_fetch['last_name'];
    $user_email = $row_fetch['email'];
    $user_phn = $row_fetch['phone'];
    $user_add = $row_fetch['address'];

    if (isset($_POST['submit'])) {
        $update_id = $user_id;
        $user_f_name = $_POST['first_name'];
        $user_l_name = $_POST['last_name'];
        $user_email = $_POST['email'];
        $user_phn = $_POST['phone'];
        $user_add = $_POST['address'];

        $update_data = "UPDATE `users` SET first_name='$user_f_name', last_name='$user_l_name', email='$user_email', phone='$user_phn', address='$user_add'  WHERE id='$update_id' ";
        $update_query = mysqli_query($conn, $update_data);
        if ($update_query) {
            echo "<script>alert('Data updated successfully');</script>";
            echo "<script>winodw.open('index.php','_self')</script>";
        }

    }
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
    <title>User profile</title>
</head>
<style>
    body {
        background: #f7f7ff;
        margin-top: 20px;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .me-2 {
        margin-right: .5rem !important;
    }
</style>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="untree_co-section  before-footer-section">

        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">


                            <div class="card-body ">
                                <form action="#" method="post">

                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="images/profile1.svg" alt="User" class="rounded-circle p-0 "
                                                width="110">
                                            <div class="mt-3 mb-3">
                                                <h4>User profile</h4>
                                                <!-- <p class="text-secondary mb-1">Full Stack Developer</p>
                                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
                                                <a class="btn btn-primary" href="logout.php">Log out</a>
                                                <input type="submit" class="btn btn-outline-primary"
                                                    value="Delete account">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary d-flex">
                                                <input type="text" class="form-control mx-1" name="first_name"
                                                    value="<?php echo $user_f_name; ?> ">

                                                    <input type="text" class="form-control" name="last_name"
                                                    value="<?php echo $user_l_name; ?>">
                                            </div>
                                            
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="email"
                                                    value="<?php echo $user_email; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="<?php echo $user_phn; ?>" name="phone"> 
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control"
                                                    value="<?php echo $user_add; ?>" name="address">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                                            </div>
                                        </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>