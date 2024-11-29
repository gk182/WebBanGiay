<?php
session_start();
include 'config.php';

// Kiểm tra nếu giỏ hàng trống
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng của bạn trống!";
    exit();
}

// Lấy thông tin từ form
if (isset($_POST['name'], $_POST['address'], $_POST['phone'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $cart = $_SESSION['cart'];

    // Tạo đơn hàng trong bảng `orders`
    $total_price = 0;
    foreach ($cart as $product_id => $details) {
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_price += $row['price'] * $details['quantity'];
    }

    // Lưu đơn hàng vào bảng `orders`
    $sql_order = "INSERT INTO orders (customer_name, address, phone, total_price, order_date) 
                  VALUES ('$name', '$address', '$phone', $total_price, NOW())";
    if ($conn->query($sql_order)) {
        $order_id = $conn->insert_id;

        // Lưu chi tiết đơn hàng vào bảng `order_details`
        foreach ($cart as $product_id => $details) {
            $quantity = $details['quantity'];
            $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity) 
                           VALUES ($order_id, $product_id, $quantity)";
            $conn->query($sql_detail);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        unset($_SESSION['cart']);
        echo "<p>Đặt hàng thành công! Cảm ơn bạn đã mua hàng.</p>";
        echo "<a href='index.php'>Tiếp tục mua sắm</a>";
    } else {
        echo "Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại!";
    }
} else {
    echo "Vui lòng nhập đầy đủ thông tin!";
}

?>
