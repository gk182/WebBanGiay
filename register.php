<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $address = $conn->real_escape_string($_POST['address']);  // Thêm địa chỉ

    // Lưu thông tin vào cơ sở dữ liệu
    $sql = "INSERT INTO users (username, email, password, address) VALUES ('$username', '$email', '$password', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Đăng ký thành công!";
        header("Location: login.php");  // Chuyển hướng đến trang đăng nhập
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-form h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .register-form label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .register-form button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .register-form button:hover {
            background-color: #45a049;
        }

        .register-form .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        .register-form .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-form .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-form .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-form">
        <h1>Đăng Ký</h1>
        
        <!-- Thông báo lỗi nếu có -->
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required> <!-- Thêm trường Địa chỉ -->

            <button type="submit">Đăng Ký</button>
        </form>

        <div class="login-link">
            Đã có tài khoản? <a href="login.php">Đăng Nhập</a>
        </div>
    </div>
</div>

</body>
</html>
