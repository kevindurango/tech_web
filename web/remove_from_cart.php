<?php
session_start();
include '../web/db_connection.php';
include '../classes/cart.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit;
}

$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

$cart = new Cart($conn, $_SESSION['user_id']);

$response = $cart->removeProduct($product_id);

header("Location: ../main/cart.php");
exit;
?>
