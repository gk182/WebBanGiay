<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="https://extrim.vn/_next/image?url=https%3A%2F%2Fextrim-prod.s3.ap-southeast-1.amazonaws.com%2Fsneaker_logo_3_f24f9e81cb.png&w=3840&q=75"
                    alt="Logo của trang web">
            </div>
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm ">
                    <input type="submit" value="Tìm kiếm">
                </form>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="#">Sản Phẩm</a></li>
                    <li><a href="#">Về Chúng Tôi</a></li>
                    <li><a href="#">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>



    <section class="hero">
        <div class="title">
            <h2>Giày mới nhất</h2>
            <p>Chào mừng bạn đến với cửa hàng giày của chúng tôi. Khám phá bộ sưu tập giày mới nhất của chúng tôi.</p>
        </div>
    </section>

    <section class="featured-products">      
            <h2>Sản phẩm nổi bật</h2>
          <div class="list-product">
              <?php include 'products.php'; ?>
          </div>
    </section>

    <aside class="sidebar">
        <div class="container">
            <div class="widget">
                <h3>Thẻ Tags</h3>
                <ul class="tag-list">
                    <li><a href="#">Giày thể thao</a></li>
                    <li><a href="#">Giày lười</a></li>
                    <li><a href="#">Giày cao gót</a></li>
                    <li><a href="#">Sneakers</a></li>
                    <li><a href="#">Giày bóng rổ</a></li>
                </ul>
            </div>
            <div class="widget">
                <h3>Danh Mục</h3>
                <ul class="category-list">
                    <li><a href="#">Nam</a></li>
                    <li><a href="#">Nữ</a></li>
                    <li><a href="#">Trẻ em</a></li>
                </ul>
            </div>
            <div class="widget">
                <h3>Bài Viết Phổ Biến</h3>
                <ul class="popular-posts">
                    <li><a href="#">Xu hướng giày mùa hè 2024</a></li>
                    <li><a href="#">5 cách phối đồ với giày sneakers</a></li>
                    <li><a href="#">Những mẫu giày mới nhất</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <footer class="footer">
        <div class="container">
            <div class="contact-info">
                <h3>Thông Tin Liên Hệ</h3>
                <p>123 Đường ABC, Phường XYZ, Quận ABC, Thành phố XYZ</p>
                <p>Số điện thoại: 0123 456 789</p>
                <p>Email: info@example.com</p>
            </div>
            <div class="quick-links">
                <h3>Liên Kết</h3>
                <ul>
                    <li><a href="#">Chính Sách</a></li>
                    <li><a href="#">Điều Khoản Sử Dụng</a></li>
                    <li><a href="#">Trợ Giúp</a></li>
                </ul>
            </div>
            <div class="social-links">
                <h3>Mạng Xã Hội</h3>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
            <div class="newsletter">
                <h3>Đăng Ký Nhận Bản Tin</h3>
                <form action="#" method="post">
                    <input type="email" name="email" placeholder="Nhập địa chỉ email của bạn">
                    <button type="submit">Đăng Ký</button>
                </form>
            </div>
        </div>
    </footer>
</body>

</html>
