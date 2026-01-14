<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit("Bạn chưa đăng nhập");
}

$user_id = $_SESSION['user_id'];
$post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

if ($post_id <= 0 || $comment === '') {
    http_response_code(400);
    exit("Thiếu dữ liệu");
}

// luu binh luan truc tiep vao db 
$mysqli->query("
    INSERT INTO comments (post_id, user_id, comment_text, created_at)
    VALUES ($post_id, $user_id, '$comment', NOW())
");

//display_name + avatar_url
$user_res = $mysqli->query("SELECT display_name, avatar_url FROM users WHERE user_id = $user_id");
$user = $user_res->fetch_assoc();

// tra ve binh luan vua them duoi dang html
echo '
<div class="comment">
    <img src="'. $user['avatar_url'] .'" alt="Avatar">
    <div class="content">
        <strong>'. htmlspecialchars($user['display_name']) .':</strong>
        '. $comment .'
    </div>
</div>';
