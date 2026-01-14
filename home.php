<?php
session_start();
if (isset($_POST['but_logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
include 'db_connect.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'nav.php';
?><main><?php


// Lấy danh sách bài đăng cùng thông tin user
$sql_posts = "
    SELECT p.post_id, p.content, p.image_url,
           u.display_name, u.avatar_url
    FROM posts p
    JOIN users u ON p.user_id = u.user_id
    ORDER BY p.created_at DESC
";
$posts_res = $mysqli->query($sql_posts);
$posts = [];
if ($posts_res) {
    while ($row = $posts_res->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>CỘNG ĐỒNG MEO MEO</title>
</head>
<body>
<?php foreach ($posts as $post): ?>
    <div class="post" data-post-id="<?= $post['post_id'] ?>">
        <div class="post-header">
            <img src="<?= $post['avatar_url'] ?>" alt="Avatar">
            <strong><?= htmlspecialchars($post['display_name']) ?></strong>
        </div>
                <p><?= htmlspecialchars($post['content']) ?></p>
        <?php if (!empty($post['image_url'])): ?>
            <img src="<?= $post['image_url'] ?>" alt="Ảnh bài đăng" class="post-img">
        <?php endif; ?>

        <div class="comments">
            <?php
            // Lấy danh sách bình luận kèm tên và avatar người cmt
            $pid = (int)$post['post_id'];
            $cmt_sql = "
                SELECT c.comment_text, u.display_name, u.avatar_url
                FROM comments c
                JOIN users u ON c.user_id = u.user_id
                WHERE c.post_id = {$pid}
                ORDER BY c.created_at ASC
            ";
            $cmt_res = $mysqli->query($cmt_sql);
            ?>
            <div class="commentList" id="commentList-<?= $pid ?>">
                <?php while ($cmt = $cmt_res->fetch_assoc()): ?>
                    <div class="comment">
                        <img src="<?= $cmt['avatar_url'] ?>" alt="Avatar">
                        <div class="content">
                            <strong><?= htmlspecialchars($cmt['display_name']) ?>:</strong>
                            <!-- CỐ TÌNH LỖ HỔNG XSS: không escape comment_text -->
                            <?= $cmt['comment_text'] ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Form bình luận (AJAX, không reload) -->
            <form class="commentForm" data-post-id="<?= $pid ?>">
                <input type="hidden" name="post_id" value="<?= $pid ?>">
                <input type="text" name="comment" placeholder="Viết bình luận..." required>
                <button type="submit" aria-label="Gửi bình luận">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10L18 2L10 18L9 11L2 10Z" fill="#7c5e9c"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<script>
// Gửi bình luận bằng AJAX cho MỖI bài viết
document.querySelectorAll(".commentForm").forEach(form => {
    form.addEventListener("submit", async function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const postId = this.dataset.postId;
        const list = document.getElementById("commentList-" + postId);

        btn.disabled = true;

        try {
            const res = await fetch("ajax_add_comment.php", {
                method: "POST",
                body: new FormData(this)
            });
            const html = await res.text();

            // Chèn bình luận mới lên cuối danh sách (hoặc dùng prepend nếu muốn lên trên)
            list.insertAdjacentHTML("beforeend", html);
            this.reset();
        } catch (err) {
            console.error(err);
            alert("Lỗi khi gửi bình luận");
        } finally {
            btn.disabled = false;
        }
    });
});
</script>
</main>
</body>
</html>
