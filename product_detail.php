<?php
include 'config.php';

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Kiểm tra xem ID sản phẩm có hợp lệ không
if ($product_id > 0) {
    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // Kiểm tra nếu câu truy vấn có lỗi
    if ($result === false) {
        echo "<p class='no-results'>Lỗi truy vấn: " . $conn->error . "</p>";
    } else {
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "<p class='no-results'>Sản phẩm không tồn tại.</p>";
        }
    }
} else {
    echo "<p class='no-results'>ID sản phẩm không hợp lệ.</p>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="css/detai.css">
</head>
<body>

<?php if (isset($product)): ?>
    <div class="product-detail">
        <h1><?php echo $product['name']; ?></h1>
        
        <?php 
        // Xử lý đường dẫn hình ảnh
        $image_path = '' . $product['image'];
        if (!file_exists($image_path)) {
            echo "Image not found: " . $image_path;
        } else {
            echo "<img src='$image_path' alt='{$product['name']}'>";
        }
        ?>

        <p class="product__price"><?php echo number_format($product['price'], 0, '.', ','); ?> VND</p>
        
        <!-- Kiểm tra xem có mô tả hay không -->
        <?php if (!empty($product['description'])): ?>
            <p class="product__description"><?php echo nl2br($product['description']); ?></p>
        <?php else: ?>
            <p class="no-description">Sản phẩm này không có mô tả.</p>
        <?php endif; ?>
        
        <!-- Form để thêm sản phẩm vào giỏ hàng -->
        <form method="POST" action="add_to_cart.php" class="product__form">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button type="submit" class="product__button">Thêm vào giỏ hàng</button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
