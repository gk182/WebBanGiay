<?php
session_start(); // Start session
include 'config.php'; // Include DB config

// Kiểm tra nếu giỏ hàng trống
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    echo "Giỏ hàng của bạn trống!";
    exit();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_address = "";

// Nếu người dùng đã đăng nhập, lấy địa chỉ từ DB
if ($user_id) {
    $sql_address = "SELECT address FROM users WHERE id = '$user_id'";
    $result_address = $conn->query($sql_address);
    if ($result_address->num_rows > 0) {
        $user_data = $result_address->fetch_assoc();
        $user_address = $user_data['address']; // Lấy địa chỉ của người dùng
    }
}

// Xử lý thông tin từ form thanh toán khi gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['address'], $_POST['phone']) &&
        !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone'])) {

        // Lấy thông tin từ form
        $name = $conn->real_escape_string($_POST['name']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);

        // Tính tổng tiền giỏ hàng
        $total_price = 0;
        foreach ($cart as $product_id => $details) {
            $sql = "SELECT price FROM products WHERE id = $product_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_price += $row['price'] * $details['quantity'];
        }

        // Lưu đơn hàng vào bảng orders
        $sql_order = "INSERT INTO orders (customer_name, address, phone, total_price, order_date) 
                      VALUES ('$name', '$address', '$phone', $total_price, NOW())";
        if ($conn->query($sql_order) === TRUE) {
            $order_id = $conn->insert_id; // Lấy ID của đơn hàng vừa tạo

            // Lưu chi tiết đơn hàng vào bảng order_details
            foreach ($cart as $product_id => $details) {
                $quantity = $details['quantity'];
                $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity) 
                               VALUES ($order_id, $product_id, $quantity)";
                $conn->query($sql_detail);
            }

            // Xóa giỏ hàng sau khi đặt hàng
            unset($_SESSION['cart']);

            echo "<script>alert('Đặt hàng thành công!'); window.location.href='index.php';</script>";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="css/pay.css"> <!-- Link to CSS -->
</head>

<body>
    <div class="container">
        <h1>Thông tin thanh toán</h1>
        
        <!-- Payment form -->
        <form method="POST" action="checkout.php">
            <div>
                <label for="name">Họ tên:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="address">Địa chỉ giao hàng:</label>
                <!-- Nếu người dùng đã đăng nhập, hiển thị địa chỉ đã đăng ký -->
                <input type="text" name="address" id="address" value="<?php echo $user_address; ?>" required>
            </div>

            <div>
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" required>
            </div>
            
            <button type="submit">Xác nhận thanh toán</button>
        </form>

        <!-- Cart summary -->
        <div class="payment-summary">
            <h2>Tổng quan giỏ hàng</h2>
            <?php
            $total_price = 0;
            foreach ($cart as $product_id => $details) {
                // Get product info from DB
                $sql = "SELECT name, price, image FROM products WHERE id = $product_id";
                $result = $conn->query($sql);
                $product = $result->fetch_assoc();

                $subtotal = $product['price'] * $details['quantity'];
                $total_price += $subtotal;
            ?>
            <div class="cart-item">
                <?php
                // Display product image
                $image_path = $product['image'];
                if (file_exists($image_path)) {
                    echo "<img src='$image_path' alt='{$product['name']}'>";
                } else {
                    echo "Image not found.";
                }
                ?>
                <div class="details">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Số lượng: <?php echo $details['quantity']; ?></p>
                </div>
                <div class="total">
                    <?php echo number_format($subtotal, 0, ',', '.'); ?> VND
                </div>
            </div>
            <?php } ?>
            
            <p>Tổng tiền: <strong><?php echo number_format($total_price, 0, ',', '.'); ?> VND</strong></p>
        </div>
    </div>
</body>

</html>
