<?php
session_start();
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $passwd   = $_POST['password'];
    
     // Cố tình không escape hoặc prepare để giữ SQLi
    $sql = "SELECT * FROM users WHERE username='$username' and passwd='$passwd'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id']  = $row['user_id'];   // Lưu user_id
        $_SESSION['username'] = $row['username']; // Lưu username
        header("Location: trangchu.php");
        exit();
    } else {
        echo "Sai username hoặc mật khẩu!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoe thú cưng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div>
            <div class="loginForm">
                <h1> Đăng nhập  </h1>
                <form action="dangnhap.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="login-btn">Log in</button> 
                </form>
            </div>
        </div>
    </div>
</body>
</html>
