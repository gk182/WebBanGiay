<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu product_id được gửi qua POST
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng rỗng
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    if (isset($_SESSION['cart'][$product_id])) {
        // Nếu có, tăng số lượng
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        // Nếu chưa, thêm sản phẩm mới vào giỏ hàng
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'quantity' => 1
        ];
    }

    // Chuyển hướng về trang trước hoặc giỏ hàng
    header("Location: cart.php");
    exit();
} else {
    echo "Không có sản phẩm nào được chọn!";
}
