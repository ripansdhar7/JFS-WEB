<?php

session_start();
include 'connection.php';


if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['address']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $payment_status = "Pending";
    $user_id = $_SESSION['user_id'];
    $price = $_SESSION['g_total'];

    $_SESSION['fname_p'] = $fname;
    $_SESSION['lname_p'] = $lname;
    $_SESSION['number_p'] = $phone;
    $_SESSION['address_p'] = $address;
    $_SESSION['email_p'] = $email;

    mysqli_query($conn, " INSERT INTO `payment` (`user_id`, `first_name`,`last_name`,`amount`,`payment_status`,`time`) VALUES('$user_id','$fname','$lname','$price','$payment_status', current_timestamp() )");
    $_SESSION['OID'] = mysqli_insert_id($conn);
}


if (isset($_POST['payment_id']) && isset($_SESSION['OID'])) {
    $payment_id = $_POST['payment_id'];

    mysqli_query($conn, " UPDATE `payment` SET `payment_status` = 'Completed', `time` = current_timestamp(), `payment_id` = '$payment_id' WHERE id = '". $_SESSION['OID'] ."'");
}