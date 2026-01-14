
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoe Thú Cưng</title>
    <link rel="stylesheet" href="style.css">
<style>
.user-info img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}
.user-info span {
    font-weight: bold;
    font-size: 16px;
    margin-right: 5px;
}

/* Mũi tên nhỏ */
.user-info::after {
    content: "▼";
    font-size: 12px;
    margin-left: 4px;
}

/* Dropdown menu */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 50px;
    right: 0;
    background: white;
    color: black;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    min-width: 150px;
    overflow: hidden;

    /* hiệu ứng */
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.25s ease;
    z-index: 1000;
}

.dropdown-menu a {
    display: block;
    padding: 10px 14px;
    text-decoration: none;
    color: black;
    font-size: 14px;
}

.dropdown-menu a:hover {
    background: #f5f5f5;
}

/* Khi mở */
.dropdown-menu.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}
.menu-btn{
    width: 100%;
    margin: 2px;
    padding: 5px;
    border:none;
}
.menu-btn:hover{
    background: #b9b9b9ff;
}
</style>
</head>
<body>
    <?php
        // Chỉ hiển thị menu nếu đã đăng nhập
        if (isset($_SESSION['user_id'])) {
            $uid = (int)$_SESSION['user_id'];
            $sql_user = "SELECT display_name, avatar_url FROM users WHERE user_id = {$uid} LIMIT 1";
            $user_res = $mysqli->query($sql_user);
            $current_user = $user_res->fetch_assoc();
    ?>
    <header class="topnav">
        <div class="nav-left">
            <h2 >PET</h2>
        </div>
        <div class="nav-center">
            <a href="home.php">TRANG CHỦ</a>
            <a href="#">VIDEO</a>
            <a href="#">NHẮN TIN</a>
            <a href="#">THÔNG BÁO</a>
        </div>
        
        <div class="user-info" onclick="toggleMenu()">
            <img src="<?= $current_user['avatar_url'] ?>" alt="Avatar">
            <span><?= htmlspecialchars($current_user['display_name']) ?></span>
            <div class="dropdown-menu" id="dropdown">
                <button class="menu-btn" onclick="location.href='#'">Đăng bài</button><br>
                <button class="menu-btn" onclick="location.href='#'">Chơi game</button><br>
                <form method="POST" action="" style="margin:0;">
                    <input type="submit" name="but_logout" value="Đăng xuất" class="menu-btn logout-btn">
                </form>
            </div>
    </div>
    </header>
    <?php
        }
    ?>
</body>
<script>
function toggleMenu() {
    document.getElementById("dropdown").classList.toggle("show");
}
</script>
</html>