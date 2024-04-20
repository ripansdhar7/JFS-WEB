<?php
include ("connection.php");

if (isset($_POST["productIncDec"])) {

    $productId = $_SESSION['productId']; //validate($_POST["product_id"]);
    $quantity = ($_POST["input-qty"]);

    foreach ($_SESSION['productId'] as $key => $item) {
        if ($_SESSION['productId']) {
            $_SESSION['productId'][$key]['input-qty'] = $quantity;
        }
    }
}

?>