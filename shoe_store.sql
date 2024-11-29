-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 06:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoe_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(14,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Nike Air Max', 2000000.00, 'images/nike_air_max.jpg'),
(2, 'Adidas Ultra Boost', 2500000.00, 'images/adidas_ultra_boost.jpg'),
(3, 'Puma Suede', 1500000.00, 'images/puma_suede.jpg'),
(4, 'Giày Air Jordan 1 Mid ‘Coral Chalk’ (GS) 554725-662', 4990000.00, 'images/giay1.jpg'),
(5, 'Giày Nike Air Jordan 4 Retro ‘Bred Reimagined’ FV5029-006', 8690000.00, 'images/giay2.jpg'),
(6, 'Giày nam Dior x Air Jordan 1 High CN8607-002', 230000000.00, 'images/giay3.jpg'),
(7, 'Giày Air Jordan 1 Mid SE ‘All Star 2021 Carbon Fiber’ (GS) DD2192-001', 10090000.00, 'images/giay4.jpg'),
(8, 'Giày Air Jordan 1 Mid Carbon Fiber / All-Star Black DD1649-001', 6690000.00, 'images/giay5.jpg'),
(9, 'Giày nam Off-White x Air Jordan 1 Retro High OG ‘UNC’ AQ0818-148', 60090000.00, 'images/giay6.jpg'),
(10, 'Giày Nike Air Jordan 1 Mid ‘Dark Iris’ 554724-095', 6290000.00, 'images/giay7.jpg'),
(11, 'Giày Nike Air Jordan 1 Mid ‘Smoke Grey’ 554724-092', 3690000.00, 'images/giay8.jpg'),
(12, 'Giày Air Jordan 1 Low Triple White 553558-130', 3390000.00, 'images/giay9.jpg'),
(13, 'Giày Air Jordan 1 Low ‘Bred Toe’ 553558-161', 2890000.00, 'images/giay10.jpg'),
(14, 'Giày Spider-Man × Nike Air Jordan 1 Retro High OG SP ‘Next Chapter’ DV1748-601', 6390000.00, 'images/giay11.jpg'),
(15, 'Giày Dior x Jordan 1 Low Grey CN8608-002', 99999999.99, 'images/giay12.jpg'),
(16, 'Giày nam Air Jordan 1 Low ‘Smoke Grey V3’ 553558-040', 4890000.00, 'images/giay13.jpg'),
(17, 'Giày Nike Air Jordan 1 Low ‘Panda’ DC0774-101', 3590000.00, 'images/giay14.jpg'),
(18, 'Giày Air Jordan 1 Low ‘White Wolf Grey’ DC0774-105', 3290000.00, 'images/giay15.jpg'),
(19, 'Giày Nike Air Jordan 1 Mid SE ‘Ice Blue’ DV1308-104', 3690000.00, 'images/giay16.jpg'),
(20, 'Giày Air Jordan 1 Mid SE ‘Diamond’ DH6933-100', 4890000.00, 'images/giay17.jpg'),
(21, 'Giày nam Air Jordan 1 x Travis Scott x Fragment Retro High OG ‘Military Blue’ DH3227-105', 168000000.00, 'images/giay18.jpg'),
(22, 'Giày nam Air Jordan 1 Low ‘Light Smoke Grey V2’ 553558-030', 4890000.00, 'images/giay19.jpg'),
(23, 'Giày Nike Air Jordan 1 Low ‘Shadow Toe’ 553558-052', 6490000.00, 'images/giay20.jpg'),
(24, 'Giày Nike Air Jordan 1 Low ‘Beaded Swoosh’ DV1762-001', 6890000.00, 'images/giay21.jpg'),
(25, 'Giày Nike Air Jordan 1 Low ‘Aluminum’ DC0774-141', 5490000.00, 'images/giay22.jpg'),
(26, 'Giày Nike Air Jordan 1 Low ‘Triple White’ 2022 DV0990-111', 3890000.00, 'images/giay23.jpg'),
(27, 'Giày Nike Air Jordan 1 Mid SE ‘Elephant Print’ DM1200-016', 4390000.00, 'images/giay24.jpg'),
(28, 'Giày Nike Air Jordan 1 Retro High OG ‘Heritage’ 555088-161', 4890000.00, 'images/giay25.jpg'),
(29, 'Giày nam Air Jordan 1 Mid White Black Royal 554724-140', 5890000.00, 'images/giay26.jpg'),
(30, 'Giày Nike Air Jordan 1 Low ‘Concord’ DV1309-100', 3690000.00, 'images/giay27.jpg'),
(31, 'Giày Air Jordan 1 Low ‘Green Toe’ 553558-371', 7690000.00, 'images/giay28.jpg'),
(32, 'Giày Air Jordan 1 Low Centre Court ‘Silver Blue’ DO7762-004', 800000.00, 'images/giay29.jpg'),
(33, 'Giày Air Jordan 1 Low ‘Alternate Royal Toe’ 553558-140', 2790000.00, 'images/giay30.jpg'),
(34, 'Giày Nike Air Jordan 1 Low ‘Court Purple’ 553560-125', 4900000.00, 'images/giay31.jpg'),
(35, 'Giày Nike Air Jordan 1 Retro High OG ‘Lost & Found’ DZ5485-612', 12490000.00, 'images/giay32.jpg'),
(36, 'Giày Nike Air Jordan 1 Low ‘Vintage Grey’ 553558-053', 4890000.00, 'images/giay33.jpg'),
(37, 'Giày Nike Air Jordan 1 Low SE Craft ‘Inside Out’ DN1635-100', 4690000.00, 'images/giay34.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,  -- Sửa tên cột này nếu cần
    addres VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Tạo bảng order_details
CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Bật kiểm tra khóa ngoại sau khi hoàn tất
SET FOREIGN_KEY_CHECKS = 1;
-- Xóa ràng buộc khóa ngoại
ALTER TABLE order_details DROP FOREIGN KEY order_details_ibfk_1;
DROP TABLE orders;
