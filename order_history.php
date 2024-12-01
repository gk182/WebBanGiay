<?php
session_start(); // Start session to check if the user is logged in
include 'config.php'; // Include your database connection

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để xem lịch sử đặt hàng!";
    exit();
}

$user_id = $_SESSION['user_id']; // Lấy user_id từ session

// Truy vấn đơn hàng của người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = $conn->query($sql);

// Kiểm tra lỗi trong truy vấn
if ($result === false) {
    echo "Lỗi khi truy vấn dữ liệu: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đơn Hàng</title>
    <link rel="stylesheet" href="css/history.css"> <!-- Tệp CSS của bạn -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Lịch Sử Đặt Hàng</h1>
        </header>

        <?php
        // Kiểm tra có đơn hàng nào không
        if ($result->num_rows > 0) {
            // Duyệt qua các đơn hàng của người dùng
            while ($order = $result->fetch_assoc()) {
                echo "<div class='order'>";
                echo "<h3>Đơn hàng #" . $order['id'] . "</h3>";
                echo "<p><strong>Tên khách hàng:</strong> " . $order['customer_name'] . "</p>";
                echo "<p><strong>Địa chỉ:</strong> " . $order['address'] . "</p>";
                echo "<p><strong>Số điện thoại:</strong> " . $order['phone'] . "</p>";
                echo "<p><strong>Tổng tiền:</strong> " . number_format($order['total_price'], 0, ',', '.') . " VND</p>";
                echo "<p><strong>Ngày đặt hàng:</strong> " . $order['order_date'] . "</p>";

                // Truy vấn chi tiết đơn hàng
                $order_id = $order['id'];
                $sql_details = "SELECT p.name, d.quantity, p.price 
                                FROM order_details d 
                                JOIN products p ON d.product_id = p.id 
                                WHERE d.order_id = '$order_id'";
                $details_result = $conn->query($sql_details);

                // Kiểm tra và hiển thị chi tiết đơn hàng
                if ($details_result && $details_result->num_rows > 0) {
                    echo "<h4>Chi tiết đơn hàng:</h4>";
                    echo "<ul>";
                    while ($detail = $details_result->fetch_assoc()) {
                        echo "<li>" . $detail['name'] . " (x" . $detail['quantity'] . "): " . 
                             number_format($detail['price'] * $detail['quantity'], 0, ',', '.') . " VND</li>";
                    }
                    echo "</ul>";
                }
                echo "</div><hr>"; // Kết thúc đơn hàng
            }
        } else {
            // Nếu không có đơn hàng
            echo "<p>Bạn chưa có đơn hàng nào!</p>";
        }
        ?>
    </div>
</body>
</html>
