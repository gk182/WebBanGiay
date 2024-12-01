<?php
session_start();
include 'config.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để đặt hàng!";
    exit(); // Dừng quá trình nếu chưa đăng nhập
}

$user_id = $_SESSION['user_id'];  // Lấy user_id từ session

// Kiểm tra nếu giỏ hàng trống
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng của bạn trống!";
    exit(); // Dừng quá trình nếu giỏ hàng trống
}

// Lấy thông tin từ form
if (isset($_POST['name'], $_POST['address'], $_POST['phone'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $cart = $_SESSION['cart'];

    // Tính tổng tiền của đơn hàng
    $total_price = 0;
    foreach ($cart as $product_id => $details) {
        // Sử dụng prepared statements để tránh SQL Injection
        $sql = "SELECT price FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_price += $row['price'] * $details['quantity'];
        } else {
            echo "Sản phẩm không tồn tại!";
            exit();
        }
    }

    // Kiểm tra nếu total_price quá lớn
    if ($total_price > 99999999.99) {
        echo "Tổng tiền quá lớn, vui lòng kiểm tra lại giỏ hàng!";
        exit();
    }

    // Lưu đơn hàng vào bảng `orders` với user_id
    $sql_order = "INSERT INTO orders (customer_name, address, phone, total_price, order_date, user_id) 
                  VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param('sssis', $name, $address, $phone, $total_price, $user_id);

    if ($stmt_order->execute()) {
        $order_id = $conn->insert_id;

        // Lưu chi tiết đơn hàng vào bảng `order_details`
        foreach ($cart as $product_id => $details) {
            $quantity = $details['quantity'];
            $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity) 
                           VALUES (?, ?, ?)";
            $stmt_detail = $conn->prepare($sql_detail);
            $stmt_detail->bind_param('iii', $order_id, $product_id, $quantity);
            $stmt_detail->execute();
        }

        // Xóa giỏ hàng sau khi đặt hàng
        unset($_SESSION['cart']);
        echo "<p>Đặt hàng thành công! Cảm ơn bạn đã mua hàng.</p>";
        echo "<a href='index.php'>Tiếp tục mua sắm</a>";
    } else {
        echo "Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại! Error: " . $stmt_order->error;
    }
} else {
    echo "Vui lòng nhập đầy đủ thông tin!";
}
?>
