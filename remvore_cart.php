<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Kiểm tra và xóa sản phẩm khỏi giỏ hàng
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    // Chuyển hướng về lại trang giỏ hàng
    header("Location: cart.php");
    exit();
}
