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

<body>
    <?php
    include 'header.php';
    ?>
    <div class="untree_co-section">
        <form action="" method="post">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 mb-5 mb-md-0 bg-white">
                        <h1 class="h3  my-4 text-black text-center">Your profile</h1>
                        <div class="d-flex justify-content-center">
                            <img src="images/profile.svg" alt="" style="max-width:5rem;">
                        </div>
                        <div class="p-3 px-lg-5 bg-white">

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">First Name</label>
                                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Last Name</label>
                                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Email</label>
                                    <input type="text" class="form-control" id="c_address" name="email"
                                        placeholder="Email address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Password </label>
                                    <input type="text" class="form-control" id="c_address" name="password"
                                        placeholder="Password">
                                </div>
                            </div>
                            <!-- <div class="box">
                            <inpt type="submit" class="option-btn" style="">update</a>
            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" >Logout</a>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-3 d-flex">
                                    <div class="row d-flex ">
                                        <div class="col-md-6 my-3 mx-1">
                                            <input type="submit" value='Update' class='btn btn-black btn-med btn-block'
                                                name='update_cart'>
                                        </div>
                                        <div class="row d-flex mx-1">
                                            <a href="shop.php" class="btn btn-black btn-md btn-block">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>

    <?php
    include 'footer.php';
    ?>
</body>

</html>