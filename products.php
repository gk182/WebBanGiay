<?php
include 'config.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT id, name, price, image FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='product__image'>";
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

$conn->close();
?>
