<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="css/cart.css"> <!-- Đường dẫn đến CSS -->
</head>
<body>
    <header>Giỏ Hàng</header>
    <div class="cart">
        <h2>Chi tiết giỏ hàng</h2>
        <?php if (!empty($cart)): ?>
            <table>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
                <?php
                $total_price = 0;
                foreach ($cart as $product_id => $item):
                    $product_name = "Sản phẩm $product_id"; // Thay thế bằng dữ liệu thực từ cơ sở dữ liệu
                    $price = 100000; // Thay thế bằng giá thực từ cơ sở dữ liệu
                    $subtotal = $item['quantity'] * $price;
                    $total_price += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($price, 0, ',', '.'); ?> VND</td>
                        <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="remove_from_cart.php?product_id=<?php echo $product_id; ?>" class="remove">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h3>Tổng tiền: <?php echo number_format($total_price, 0, ',', '.'); ?> VND</h3>
            <a href="checkout.php" class="checkout-btn">Thanh Toán</a>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống!</p>
        <?php endif; ?>
    </div>
</body>
</html>
