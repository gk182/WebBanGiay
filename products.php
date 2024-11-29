<?php
include 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$products_per_page = 12;
$offset = ($page - 1) * $products_per_page;

$total_sql = "SELECT COUNT(*) as total FROM products WHERE name LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

$total_pages = ceil($total_products / $products_per_page);

$sql = "SELECT id, name, price, image FROM products WHERE name LIKE '%$search%' LIMIT $offset, $products_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Liên kết đến trang chi tiết sản phẩm khi click vào ảnh
        echo "<div class='product'>";
        echo "<a href='product_detail.php?id=" . $row["id"] . "'><img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='product__image'></a>";
        echo "<h2 class='product__name'>" . $row["name"] . "</h2>";
        echo "<p class='product__price'>" . number_format($row["price"], 0, '.', ',') . " VND</p>";
        echo "<form method='POST' action='add_to_cart.php' class='product__form'>";
        echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
        echo "<button type='submit' class='product__button'>Thêm vào giỏ hàng</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p class='no-results'>Không có sản phẩm nào</p>";
}

if ($total_pages > 1) {
    echo "<div class='pagination' style='text-align: right; display: flex; justify-content: flex-end; gap: 10px;'>";
   
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<span class='current-page' style='display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: white; border-radius: 5px;'>$i</span>";
        } else {
            echo "<a href='?search=$search&page=$i' style='display: inline-block; padding: 10px 15px; background-color: #f1f1f1; color: black; text-decoration: none; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s;' 
            onmouseover='this.style.backgroundColor=\"#e0e0e0\";' 
            onmouseout='this.style.backgroundColor=\"#f1f1f1\";'>$i</a>";
        }
    }

    echo "</div>";
}
?>
