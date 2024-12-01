<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu người dùng đã đăng nhập
$is_logged_in = isset($_SESSION['user_id']);

// Chuyển hướng nếu người dùng đã đăng nhập
if ($is_logged_in && basename($_SERVER['PHP_SELF']) == "login.php") {
    // Nếu đã đăng nhập và đang ở trang đăng nhập, chuyển hướng về trang chủ
    header("Location: index.php");
    exit();
}

// Chuyển hướng nếu người dùng chưa đăng nhập và đang ở trang yêu cầu đăng nhập
if (!$is_logged_in && (basename($_SERVER['PHP_SELF']) == "checkout.php" || basename($_SERVER['PHP_SELF']) == "account.php")) {
    // Nếu chưa đăng nhập và đang ở trang thanh toán hoặc trang tài khoản, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo của trang web">
        </div>
        <div class="search-bar">
            <form method="GET" action="products.php">
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                <input type="submit" value="Tìm kiếm">
            </form>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="index.php">Sản Phẩm</a></li>
                <li><a href="about.php">Về Chúng Tôi</a></li>
                <li><a href="contact.php">Liên Hệ</a></li>

                <!-- Kiểm tra trạng thái đăng nhập -->
                <?php if ($is_logged_in): ?>
                    <li><a href="order_history.php"> Đơn Hàng</a></li> <!-- New link for order history -->
                    <li><a href="logout.php">Đăng Xuất</a></li>
                <?php else: ?>
                    <li><a href="login.php">Đăng Nhập</a></li>
                    <li><a href="register.php">Đăng Ký</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

